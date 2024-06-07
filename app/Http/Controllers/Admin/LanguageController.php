<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware(['verified','auth']);
    }

    public function index(Request $request)
    {
        $pageName = __('Language Management');
        $language = Language::whereCode($request->key)->first();
        if($request->key && $language) {
            $strings = $this->get($request->key);
            return view('admin.languages', compact('language', 'strings', 'pageName'));
        } else {
            abort(404);
        }
    }

    public function get($lang)
    {
        $dir = base_path() . '/resources/lang/' . $lang;
        $arrLabel   = json_decode(file_get_contents($dir . '.json'));
        $arrFiles   = array_diff(
            scandir($dir),
            array(
                '..',
                '.',
            )
        );
        $arrMessage = [];
        foreach ($arrFiles as $file) {
            $fileName = basename($file, ".php");
            $fileData = $myArray = include $dir . "/" . $file;
            if (is_array($fileData)) {
                $arrMessage[$fileName] = $fileData;
            }
        }
        return [$arrLabel, $arrMessage];
    }

    public function buildArray($fileData)
    {
        $content = "";
        foreach ($fileData as $lable => $data) {
            if (is_array($data)) {
                $content .= "'$lable'=>[" . $this->buildArray($data) . "],";
            } else {
                $content .= "'$lable'=>'" . addslashes($data) . "',";
            }
        }

        return $content;
    }

    public function update_exec($lang, $data)
    {
        $dir        = base_path() . '/resources/lang';
        if (!is_dir($dir)) {
            mkdir($dir);
            chmod($dir, 0777);
        }
        $jsonFile = $dir . "/" . $lang . ".json";
        if (isset($data['label']) && !empty($data['label'])) {
            file_put_contents($jsonFile, json_encode($data['label']));
        }

        $langFolder = $dir . "/" . $lang;

        if (!is_dir($langFolder)) {
            mkdir($langFolder);
            chmod($langFolder, 0777);
        }
        if (isset($data['message']) && !empty($data['message'])) {
            foreach ($data['message'] as $fileName => $fileData) {
                $content = "<?php return [";
                $content .= $this->buildArray($fileData);
                $content .= "];";
                file_put_contents($langFolder . "/" . $fileName . '.php', $content);
            }
        }
    }

    public function update(Request $request)
    {
        $this->update_exec($request->language_code, $request->strings);
        $response = [
            'status' => 'success',
            'msg' => __('Update language successfully!'),
        ];
        return redirect()->route('admin.language', ['key' => $request->language_code])->with('response', $response);
    }

    private function recursiveCopy($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst);

        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    $this->recursiveCopy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    public function create(Request $request)
    {
        $rules = [
            'code' => ['required', 'string', 'max:191'],
        ];
        $request->validate($rules);

        $language = Language::create([
            'code' => $request->code,
            'name' => Language::LANG[$request->code],
        ]);

        if ($language) {
            $directory = [resource_path('lang/en'), resource_path('lang/' . $language->code)];
            $json = [resource_path('lang/en.json'), resource_path('lang/' . $language->code . '.json')];
            $this->recursiveCopy($directory[0], $directory[1]);
            copy($json[0], $json[1]);
        }

        $response = [
            'status' => 'success',
            'msg' => __('Update language successfully!'),
        ];
        return redirect()->route('admin.language', ['key' => $language->code])->with('response', $response);
    }

    public function change(Request $request)
    {
        app()->setLocale($request->language, config('app.locale'));
        Session::put('language', $request->language);
        $language = Language::whereCode($request->language)->first();
        Session::put('settings', Setting::where('language_id', $language->id)->pluck('value', 'key'));
        return redirect()->back();
    }
}
