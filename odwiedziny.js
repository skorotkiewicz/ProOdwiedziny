
// Skrypt OdwiedzinyPro ver 2.0
// Wszelkie prawa zastrzeżone!
// Copyright © 2011 ITUnix.eu. All rights reserved. 

document.write('<iframe width="1" height="1" frameborder="0" src="http://DOMENA.TLD/odwiedziny.php'+
'?profile_id='+_zapytaj['profile']['id']+'&'+
'profile_nick='+encodeURIComponent(_zapytaj['profile']['nick'])+'&'+
'profile_avatar='+encodeURIComponent(_zapytaj['profile']['avatar'])+'&'+
'guest_id='+_zapytaj['guest']['id']+'&'+
'guest_nick='+encodeURIComponent(_zapytaj['guest']['nick'])+'&'+
'guest_avatar='+encodeURIComponent(_zapytaj['guest']['avatar'])+
'" ></iframe>');

