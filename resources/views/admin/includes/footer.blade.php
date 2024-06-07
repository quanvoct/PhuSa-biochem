<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p> {{ isset(session('settings')['company_name']) ? session('settings')['company_name'] : '' }} &copy; {{ date("Y") }}</p>
        </div>
        <div class="float-end">
            <p>Xây dựng bằng <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span> bởi <a href="https://keydigital.vn">Key Digital</a></p>
        </div>
    </div>
</footer>