<?php
if (isset($_GET['search'])) {
    $ch = @curl_init();
    //@curl_setopt($ch, CURLOPT_URL,'https://myanimelist.net/anime/34332');
    @curl_setopt($ch, CURLOPT_URL,'https://myvideogamelist.com/search');
    @curl_setopt($ch, CURLOPT_POSTFIELDS,"searchterm=".$_GET['search']);
    //@curl_setopt ( $ch, CURLOPT_HEADER, TRUE );
    //@curl_setopt ( $ch, CURLOPT_NOBODY, TRUE );
    @curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, TRUE );
    @curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, TRUE );
    curl_setopt  ($ch, CURLOPT_FILETIME, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $html = curl_exec($ch);// acessar URL
    $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);// Pegar o c�digo de resposta
    curl_close($ch);
    
    if ($response_code == '404') {
        echo 'Página não existente';
    } else {
//         var_dump($html);
    
//         echo $html;
           
        $games = array(); 
        
        if(preg_match('/<li><a href="\/addlist\/(.*?)">/', $html, $unico) 
           && preg_match('/heading">\s<h6 class="panel-title">(.*?)<\//', $html, $nome) ){
//             var_dump($unico);
//             var_dump($nome);
            
            $games[0]["url"] = "https://myvideogamelist.com/gameprofile/".$unico[1];
            $games[0]["cod"] = $unico[1];
            $games[0]["game"] = $nome[1];
            echo json_encode($games,true);
            return;
        }
    
    
        if(preg_match_all('/class=\"media-heading\"><a href=\"\/gameprofile\/(.*?)\/.*?\">(.*?)<\/a>/', $html, $tit)){
    //         var_dump($tit);
    
            foreach($tit[0] as $key=>$g){
    //             var_dump($g);
                $games[$key]["cod"] = $tit[1][$key];
                $games[$key]["game"] = $tit[2][$key];
                $games[$key]["url"] = "https://myvideogamelist.com/gameprofile/".$tit[1][$key];
            }
            
            echo json_encode($games,true);
            return true;
        }
    
    }

}
echo '{"sit":1}';
return false;
?>