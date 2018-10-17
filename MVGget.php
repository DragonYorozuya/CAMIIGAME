<?php
if (isset($_GET['game'])) {
    
    $ch = @curl_init();
    //@curl_setopt($ch, CURLOPT_URL,'https://myvideogamelist.com/gameprofile/45');
    @curl_setopt($ch, CURLOPT_URL,'https://myvideogamelist.com/gameprofile/'.$_GET['game']);
//     @curl_setopt($ch, CURLOPT_POSTFIELDS,"searchterm=".$_GET['search']);
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
           
        $game = array(); 
        
        if(preg_match('/<li><a href="\/addlist\/(.*?)">/', $html, $cod)
           && preg_match('/heading">\s<h6 class="panel-title">(.*?)<\//', $html, $nome)
           && preg_match('/<dt>Platform<\/dt>\s<dd>(.*?)<\/dd>/', $html, $plataforma)
           && preg_match('/<dt>Developer\(s\)<\/dt>\s<dd>(.*?)<\/dd/', $html, $dev)
           && preg_match('/<dt>Publisher\(s\)<\/dt>\s<dd>(.*?)<\/dd/', $html, $public)
           && preg_match('/center"><img style="max-width: 200px;" src="\/images\/boxart\/(.*?)">/', $html, $img)
            ){
//             var_dump($img);

                
            $game['cod'] = $cod[1];
            $game['nome'] = $nome[1];
            $game['plataforma'] = $plataforma[1];
            $game['dev'] = $dev[1];
            $game['public'] = $public[1];
            $game['img']['url'] = "https://myvideogamelist.com/images/boxart/".$img[1];
            $game['img']['nome'] = $img[1];
        }
        
       
        
        echo json_encode($game,true);
        return;
        

    
    
//         if(preg_match_all('/class=\"media-heading\"><a href=\"(.*?)\">(.*?)<\/a>/', $html, $tit)){
//     //         var_dump($tit);
    
//             foreach($tit[0] as $key=>$g){
//     //             var_dump($g);
//                 $games[$key]["url"] = "https://myvideogamelist.com".$tit[1][$key];
//                 $games[$key]["game"] = $tit[2][$key];
//             }
            
//             echo json_encode($games,true);
//             return true;
//         }
    
    }

}
echo '{"sit":1}';
return false;

?>