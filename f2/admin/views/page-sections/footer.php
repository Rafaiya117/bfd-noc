
<?php 
    echo '<script> let APP_URL="',APP_URL,'"; </script>';
    echo '<!--all JS!! --->',PHP_EOL;
    
    write_js($js_libs ,APP_URL);
    write_js($js_libs_sites ,'');
    echo '<!--extra JS --->',PHP_EOL;
    write_js($js_add_footer, APP_URL);
?>
<br>
<footer>
    <div class="footer">
        
        <p> <a href="https://bforest.gov.bd/" > Bangladesh Forest Department </a></p>
    </div>
</footer>
</div>
</body>
</html>