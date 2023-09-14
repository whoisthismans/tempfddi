<?php 
	include_once('./includes.php');
	$mainPage = "academics.php";
	$sitePage = "management-faculty.php";
	$banner_id=26;
	$metaDetails		= 	$common->getMetaInfo(19,1);//[tag_id,status]
	$management_faculty	= 	$common->getManagementFaculty(1,1);//[management_id,status]
	$management_images	= 	$common->getManagementImages(1);//[status]
	$subPageBanner		=	$common->getSubBannerContents(13,1);//[page_id,status]
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-133185536-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-133185536-1');
</script>
<!-- Global site tag (gtag.js) - Google Ads: 762144817 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-762144817"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-762144817');
</script>
<!-- Facebook Pixel Code --> 
<script> 
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod? 
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n; 
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0; 
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window, 
document,'script','https://connect.facebook.net/en_US/fbevents.js'); 
fbq('init', '1893642017579788'); 
fbq('track', 'PageView'); 
</script> 
<noscript><img height="1" width="1" style="display:none" 
src="https://www.facebook.com/tr?id=1893642017579788&ev=PageView&noscript=1" 
/></noscript> 
<!-- DO NOT MODIFY --> 
<!-- End Facebook Pixel Code -->
    <?php include 'meta.php';?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TMPF9TS');</script>
<!-- End Google Tag Manager -->
</head>
<body>
<?php include 'header.php';?>
    
    <?php include 'sub_banner.php';?>

    <?php include 'academic_sub_menu.php';?>

    <section class="management-faculty">
        <div class="container">
            <div class="acca-prgm-box">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="acca-prgm-box-left">
						<?php 
							$thumb_path 		= 	$configDetails['academicResizeImgDir']._output($management_faculty['image']);
						?>
                            <img class="img-responsive" src="<?=$thumb_path?>" alt="">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="acca-prgm-box-right">
                            <h4>The Management & Faculty</h4>
                           <?=_output($management_faculty['content'])?>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="executive-profile-block campus-overview-block">
        <ul>
            <li>
                <div class="container">
                    <div class="patna-gallery-main">
                        <div class="row">
						
						<?php 
							foreach($management_images as $key=>$values){
								$thumb_path = 	$configDetails['managementResizeImgDir']._output($values['image']);
						?>
                            <div class="col-sm-6">
                                <div class="patna-gallery-box">
                                    <img class="img-responsive" src="<?=$thumb_path?>" alt="">
                                </div>
                            </div>
						<?php } ?>	
                            
                        </div>
                    </div>
                </div>
            </li>
            
        </ul>
    </section>
    
    
    <?php include 'footer.php';?>
	<?php include 'footer_js.php';?>
    </body>
</html>