
<?php if($_SESSION['country']!='en'){?>
<div id="google_translate_element" style="display:none;"></div> <!-- Ẩn Widget -->
<script type="text/javascript">
  // function googleTranslateElementInit() {
  //   new google.translate.TranslateElement(
  //     {pageLanguage: 'en', includedLanguages: '<?=$_SESSION['country']?>', autoDisplay: false},
  //     'google_translate_element'
  //   );
  // }
</script>
<!-- <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> -->

<script type="text/javascript">
  // // Hàm tự động chọn tiếng Việt
  // function triggerTranslate() {
  //   var element = document.querySelector("select.goog-te-combo");
  //   if (element) {
  //     element.value = '<?=$_SESSION['country']?>';  // Chọn ngôn ngữ Việt Nam
  //     element.dispatchEvent(new Event('change'));  // Kích hoạt sự kiện thay đổi
  //   }
  // }

  // // Đợi trang dịch xong và tự động dịch khi trang tải
  // setTimeout(triggerTranslate, 2000);
</script>
<!-- <style>
    .skiptranslate{
        display:none !important;
    }
    body{
      top:0px !important
    }
</style> -->
<?php }?>