<?php
function reverse($name,$arguments=array()){
  //return absolute url of url_name;
  global $urlpatterns;
  $path = array_column($urlpatterns,0,2)[$name];
  //0 is urlpath and 2 is its name
  $arra = preg_split("@/@",$path,-1,PREG_SPLIT_NO_EMPTY);
  $pattern = "/[(].*?[)]/";
  $count=0;
  foreach($arra as $key=>&$value) {
    if(preg_match($pattern,$value)){
      $value = $arguments[$count];
      $count++;
    }
  }
  $url = implode('/',$arra);
  $url = substr(trim($path),0,1)=="/"?"/".$url:$url;
  $url = substr(trim($path),-1,1)=="/"?$url."/":$url;
  if(count($arra)==0) return "/";
  return $url;
}

function staticfile($staticfile){
  $dirs = STATICFILES["DIRS"];
    $dirs = array_merge($dirs,APPS);
    //AUTOLOAD_STATICFILES["DIRS"],
    $i = 0;
    foreach($dirs as $dir){
      $a =  glob($dir."/static/$staticfile");
      if(count($a)>0) return (substr($a[0],0,1)=="/"?$a[0]:"/".$a[0]);
      $i++;
    }
  return "";
}