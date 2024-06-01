<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{

    public function index()
    {
        $pageName = __('Language Management');
        $vn = $this->get('vn');
        $en = $this->get('en');
        return view('admin.languages', compact('vn', 'en', 'pageName'));
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
        $this->update_exec('vn', $request->vn);
        $this->update_exec('en', $request->en);
        $response = [
            'success' => true,
            'msg' => __('Update language successfully!'),
        ];
        return redirect()->route('admin.language')->with('response', $response);
    }

    public function change(Request $request)
    {
        app()->setLocale($request->language, config('app.locale'));
        Session::put('language', $request->language);
        return redirect()->back();
    }
}
