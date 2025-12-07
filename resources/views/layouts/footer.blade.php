	
  <?php 
$language_id = Session::get('language_id');
$footer_translations = getbackendTranslations('Login Screen',null,$language_id);
 
 ?>

<footer class="main-footer"> <strong><a href="#">Al Masaood Auto. </a></strong>All rights reserved.
  <div class="float-right d-none d-sm-inline-block">   @if ($footer_translations['login_footer']) {{$footer_translations['login_footer']}} @else <b>Powered By </b> Marka Communications   @endif</div> 


</footer>