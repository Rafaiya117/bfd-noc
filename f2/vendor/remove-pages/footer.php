<br></div>
<?php 
    echo '<!--all JS!! --->',PHP_EOL;
    write_js($js_libs ,VENDOR_URL);
    echo '<!--extra JS --->',PHP_EOL;
    write_js($js_add_footer, VENDOR_URL);
?>
</body>
</html>