
    
    
   <!-- <div id="newVcodeIframe" style="background: none rgb(255, 255, 255); position: absolute; width: 300px; left: 50%; margin-left: -150px; z-index: 9999;"><iframe frameborder="0" border="0" marginheight="0" marginwidth="0" scrolling="no" style="width: 300px; height: 230px; border: 0px; position: relative; left: 0px; top: 0px; z-index: 2000000002;" src="https://ssl.captcha.qq.com/cap_union_new_show?aid=716027609&amp;asig=&amp;captype=&amp;protocol=https&amp;clientype=2&amp;disturblevel=&amp;apptype=2&amp;curenv=inner&amp;ua=TW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hyb21lLzcwLjAuMzUzOC4xMDIgU2FmYXJpLzUzNy4zNg==&amp;sess=OrLgwkz57Bn3j7fytnYAl4rOo95OZ3-MIFkgkMgwGLD_x3CByZXswo0iIUHPe_7R590k5KaL5lqFNWae_wPHgDKWwfBX2V0lNAyNkymxEGU_YWW-ejCe8cO3fvXGF_KTxtkD13qa2mbtosg9mQi79t2cRwMFiFQ_YifHdALsv5-CDnLbyMGVxgxJXWAFZo-gUZnhC8Pe2W0*&amp;theme=&amp;sid=6632503706898620797&amp;noBorder=noborder&amp;fb=1&amp;forcestyle=undefined&amp;subsid=2&amp;showtype=embed&amp;uid=1243765891&amp;cap_cd=GaSnRUk7M9jjP3u7UNOZxo-4Qq_zaBo7NqxT0zx_kldVKM7WS0zo8w**&amp;lang=2052&amp;rnd=311533&amp;TCapIframeLoadTime=16&amp;prehandleLoadTime=36&amp;createIframeStart=1544250109929"></iframe></div> -->
<?php
echo ascii_to_str("5D5C8CDF13");
function ascii_to_str($sacii){
        $asc_arr= str_split(strtolower($sacii),2);
        $str="";
        for($i=0;$i<count($asc_arr);$i++){
            $str.=chr(hexdec($asc_arr[$i][1].$asc_arr[$i][0]));
        }
        return mb_convert_encoding($str,'UTF-8','GB2312');
    }
?>