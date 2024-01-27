<style type="text/css" >
    div.slideshow img {width:600px;height:260px}
</style>
<center>
<div class="slideshow" id="slideshow" >
    <?php
    $conn = new mysqli("localhost", "admin01", "123admin123", "ban_hang");
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối không thành công: " . $conn->connect_error);
    }

    $tv = "SELECT hinh, lien_ket FROM slideshow ORDER BY id";
    $result = $conn->query($tv);

    while ($tv_2 = $result->fetch_assoc()) {
        $link_hinh = "chuc_nang/hinh_anh/slideshow/" . $tv_2['hinh'];
        echo "<a href='" . $tv_2['lien_ket'] . "'>";
        echo "<img src='" . $link_hinh . "'>";
        echo "</a>";
    }

    // Đóng kết nối
    $conn->close();
?>
</div>
</center>
<script type="text/javascript" >

    var i_img=0;
    var div_slideshow=document.getElementById("slideshow");
    var img_slideshow=div_slideshow.getElementsByTagName("img");
    for(var i=0;i<img_slideshow.length;i++)
    {
        img_slideshow[i].style.display="none";
    }
    img_slideshow[0].style.display="block";
  
    setInterval(function(){
        img_slideshow[i_img].style.display="none";
        i_img=i_img+1;
        if(i_img>=img_slideshow.length){i_img=0;}
        img_slideshow[i_img].style.display="block";      
    },5000);
</script>