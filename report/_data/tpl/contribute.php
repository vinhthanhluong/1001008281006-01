<?php

	$setting=unserialize(@file_get_contents(DATA_DIR.'/setting/overnotes.dat'));
	ini_set('mbstring.http_input', 'pass');
	parse_str($_SERVER['QUERY_STRING'],$_GET);
	$keyword=isset($_GET['k'])?trim($_GET['k']):'';
	$category=isset($_GET['c'])?trim($_GET['c']):'';
	$page=isset($_GET['p'])?trim($_GET['p']):'';
	$base_title = !empty($setting['title'])? $setting['title'] : 'OverNotes';

?><?php
	$contribute=get_contribute($contribute_id);
		$title=$contribute['title'];
	$category_id=$contribute['category'];
	$category_data=unserialize(@file_get_contents(DATA_DIR.'/category/'.$category_id.'.dat'));
	$category_name=$category_data['name'];
	$category_text=@$category_data['text'];
	$category_url=$category_data['id'];
	$field_id=$contribute['field'];
	$id=$contribute['id'];
	$field=get_field($field_id);
	$date=$contribute['public_begin_datetime'];
	$url=$contribute['url'].'/';

	foreach($field as $field_index=>$field_data){
		${$field_data['code'].'_Name'}=$field_data['name'];
		${$field_data['code'].'_Value'}=make_value(
		$field_data['name']
				,@$contribute['data'][$field_id][$field_index]
			,$field_data['type']
			,$id
			,$field_id
			,$field_index
		);
		if($field_data['type']=='image'){
			${$field_data['code'].'_Src'}=ROOT_URI.'/_data/contribute/images/'.@$contribute['data'][$field_id][$field_index];
		}
	}

?>
<?php
$current_category_id   = $category_id;
$current_category_name = $category_name;
?>
<?php
	$category_index=get_category_index();
	foreach($category_index as $rowid=>$id){
		$category_data=unserialize(@file_get_contents(DATA_DIR.'/category/'.$id.'.dat'));
		$category_url=$category_data['id'];
		$category_name=$category_data['name'];
		$category_text=@$category_data['text'];
		$category_id=$id;
		${'category'.$id.'_url'}=$category_data['id'];
		${'category'.$id.'_name'}=$category_data['name'];
		${'category'.$id.'_text'}=@$category_data['text'];
		$selected=(@$_GET['c']==$id?' selected="selected"':'');

?>
	<?php if( $current_category_id==$category_id ) $current_category_url = $category_url; ?>
<?php
	}
?>
<!Doctype html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone=no">
	<title><?php echo $title; ?>|<?php echo $base_title; ?>｜排水管・給水管の内視鏡調査なら　株式会社三央</title>
	<?php
	if($keywords_Value){
?>
		<meta name="keywords" content="<?php echo $keywords_Value; ?>" />
		<?php
	}else{
?>
			<meta name="keywords" content="レポート,調査,排水管" />
	<?php
	}
?>
	<?php
	if($description_Value){
?>
		<meta name="description" content="<?php echo $description_Value; ?>" />
		<?php
	}else{
?>
			<meta name="description"
				content="排水管・給水管の材質や形状、設置の状況、また使用条件などは建物によってまったく異なるものです。そのため配管調査の方法や結果も多岐に渡ります。こちらでは、株式会社三央における排水管・給水管調査レポートを一覧にしてご紹介します。" />
	<?php
	}
?>
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<link rel="shortcut icon" href="../../images/favicon.ico" type="image/x-icon">
	<!-- CSS -->
	<link href="../../css/styles.css" rel="stylesheet" type="text/css" />
	<link href="../../css/responsive.css" rel="stylesheet" type="text/css" />
	<link href="../../css/under.css" rel="stylesheet" type="text/css" />
	<link href="../../css/under_responsive.css" rel="stylesheet" type="text/css" />

	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-XXVGLV5SLQ"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());

		gtag('config', 'G-XXVGLV5SLQ');
	</script>
	<!-- Google Tag Manager -->
	<script>(function (w, d, s, l, i) {
			w[l] = w[l] || []; w[l].push({
				'gtm.start':
					new Date().getTime(), event: 'gtm.js'
			}); var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
					'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-TWG5DRC');</script>
	<!-- End Google Tag Manager -->

	<script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": 
            [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "item": {	
                        "@id": "https://www.san-oh-research.jp/",
                        "name": "排水管・給水管の内視鏡調査なら　株式会社三央"
                    }
                },
                {
                    "@type": "ListItem",
                    "position": 2,
                    "item": {
                        "@id": "https://www.san-oh-research.jp/basic/report/",
                        "name": "<?php echo $base_title; ?>｜排水管・給水管の内視鏡調査なら　株式会社三央"
                    }
                },
				{
                    "@type": "ListItem",
                    "position": 3,
                    "item": {
                        "@id": "https://www.san-oh-research.jp/basic/report/<?php echo $current_category_url; ?>",
                        "name": "<?php echo $current_category_name; ?>|<?php echo $base_title; ?>｜排水管・給水管の内視鏡調査なら　株式会社三央"
                    }
                },
				{
                    "@type": "ListItem",
                    "position": 4,
                    "item": {
                        "@id": "https://www.san-oh-research.jp/basic/report/<?php echo $url; ?>",
                        "name": "<?php echo $title; ?>|<?php echo $base_title; ?>｜排水管・給水管の内視鏡調査なら　株式会社三央"
                    }
                }
            ]
        }
    </script>
</head>

<body class="under">
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TWG5DRC" height="0" width="0"
			style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<div id="wrapper">
		<header id="header">
			<div class="header-wrap">
				<h1>排水管・給水管の内視鏡調査を行う株式会社三央、「調査レポート」のページ</h1>
				<div class="header-main">
					<div class="logo">
						<a href="https://www.san-oh-research.jp/">
							<img src="../../images/logo.png" width="279" height="69" loading="lazy" alt="SANOH 株式会社 三央">
						</a>
					</div>

					<div class="header-menu">
						<ul class="menu-list">
							<li class="dropdown">
								<span>
									事業案内
									<span class="mu-en">SERVICE</span>
								</span>
								<div class="sub-menu">
									<div class="sub-wrap">
										<div class="sub-txt">
											<p class="sub-en">SERVICE</p>
											<p class="sub-jp">事業案内</p>
										</div>
										<ul class="sb-m">
											<li>
												<a href="../../about/service.html">サービス一覧</a>
											</li>
											<li>
												<a href="../../basic/endoscope.html">排水管・給水管の内視鏡調査</a>
											</li>
											<li>
												<a href="../../basic/endoscope2.html">漏水調査</a>
											</li>
											<li>
												<a href="../../about/waterleak.html">調査機材紹介</a>
											</li>
										</ul>
									</div>
								</div>
							</li>
							<li>
								<a href="../../about/price.html">
									料金表
									<span class="mu-en">PRICE</span>
								</a>
							</li>
							<li>
								<a href="../../results/list.html">
									調査実績一覧
									<span class="mu-en">RESULTS</span>
								</a>
							</li>
							<li>
								<a href="../../about/concept.html">
									三央の強み
									<span class="mu-en">STRENGTH</span>
								</a>
							</li>
							<li class="dropdown">
								<span>
									会社案内
									<span class="mu-en">COMPANY</span>
								</span>
								<div class="sub-menu">
									<div class="sub-wrap">
										<div class="sub-txt">
											<p class="sub-en">COMPANY</p>
											<p class="sub-jp">会社案内</p>
										</div>
										<ul class="sb-m">
											<li>
												<a href="../../about/company.html">会社概要 </a>
											</li>
											<li>
												<a href="../../about/interview.html">代表挨拶 </a>
											</li>
											<li>
												<a href="../../about/faq.html">対応エリア・よくあるご質問</a>
											</li>
											<li>
												<a href="../../about/flow.html">お問い合わせからの流れ</a>
											</li>
										</ul>
									</div>
								</div>
							</li>
							<li>
								<a href="../../report/">
									新着調査レポート
									<span class="mu-en">REPORT</span>
								</a>
							</li>
							<li class="dropdown">
								<span>
									基礎知識
									<span class="mu-en">KNOWLEDGE</span>
								</span>
								<div class="sub-menu">
									<div class="sub-wrap">
										<div class="sub-txt">
											<p class="sub-en">KNOWLEDGE</p>
											<p class="sub-jp">排水管・給水管の基礎知識</p>
										</div>
										<ul class="sb-m">
											<li>
												<a href="../../basic/drainpipe.html">トラブルが起きる前に定期的な調査を </a>
											</li>
											<li>
												<a href="../../beforetrouble.html">繰り返すそのトラブル、調査が必要かも </a>
											</li>
											<li>
												<a href="../../aftertrouble.html">専門会社へ調査依頼するメリット</a>
											</li>
										</ul>
									</div>
								</div>
							</li>
							<li>
								<a href="../../for/owner.html">
									マンション管理組合様
									<span class="mu-en">ORNER / MANAGEMENT</span>
								</a>
							</li>
							<li>
								<a href="../../for/builder.html">
									工事業者様
									<span class="mu-en">CONTRACTOR</span>
								</a>
							</li>
						</ul>
						<div class="header-act sp">
							<ul class="act-list">
								<li class="act-tel">
									<p class="act-img">
										<img src="../../images/ic-fphone.png" width="45" height="45" alt="phone">
									</p>
									<p class="act-phone">
										03-3659-8657
									</p>
									<p class="act-ds">
										平日8：00-19：00
									</p>
									<a href="tel:0336598657" onclick="gtag('event', 'tel', {'event_category': 'sp'});"
										class="lk-full sweetlink"></a>
								</li>
								<li class="act-email">
									<p class="act-img">
										<img src="../../images/ic-femail.png" width="45" height="45" alt="WEBお問い合わせ">
									</p>
									<p class="act-tt">
										WEBお問い合わせ
									</p>
									<p class="act-ds">
										24時間受付中
									</p>
									<a href="../../contact/" class="lk-full"></a>
								</li>
								<li class="act-address">
									<p class="act-tt2">
										株式会社三央
									</p>
									<p class="act-ds">
										〒133-0051<br>
										東京都江戸川区北小岩3-1-24
									</p>
								</li>
							</ul>
						</div>
					</div>

					<div class="hamburger-btn">
						<div class="bar">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
							<span></span>
							<span></span>
						</div>
					</div>
				</div>
			</div>
		</header>
		<div class="btns-fix">
			<ul class="bns-list">
				<li class="bns-tel">
					<p class="bns-img">
						<img src="../../images/ic-fphone.png" width="45" height="45" alt="phone">
					</p>
					<p class="bns-phone">
						03-3659-8657
					</p>
					<p class="bns-ds">
						平日8：00-19：00
					</p>
					<a href="tel:0336598657" onclick="gtag('event', 'tel', {'event_category': 'sp'});"
						class="lk-full sweetlink"></a>
				</li>
				<li class="bns-email">
					<p class="bns-img">
						<img src="../../images/ic-femail.png" width="45" height="45" alt="WEBお問い合わせ">
					</p>
					<p class="bns-tt">
						WEBお問い合わせ
					</p>
					<p class="bns-ds">
						24時間受付中
					</p>
					<a href="../../contact/" class="lk-full"></a>
				</li>
			</ul>
		</div>
		<!-- end #header-->
		<main id="main" class="main-under">
			<!-- top info = main visual -->
			<div id="mainvisual" class="under-visual"
				style="background-image: url('../../images/ud-visual-img01.jpg');">
				<div class="container">
					<h2>
						<span class="h2-jp"><?php echo $title; ?></span>
						<span class="h2-en">report</span>
					</h2>
				</div>
			</div>
			<!-- end #top_info -->

			<div id="content">
				<div id="topic-path">
					<ul class="topic-list">
						<li><a href="https://www.san-oh-research.jp/">Home</a></li>
						<li><?php echo $title; ?></li>
					</ul>
				</div>

				<div class="section">
					<div class="overnote-detail">
						<?php
	if($img01_Value || $text01_Value){
?>
							<div class="detail-box">
								<?php
	if($img01_Value){
?>
									<p class="detail-img">
										<img src="<?php echo $img01_Src; ?>" alt="<?php echo $title; ?>">
									</p>
								<?php
	}
?>
								<?php
	if($text01_Value){
?>
									<div class="detail-desc">
										<?php echo mb_strimwidth($text01_Value, 0, 0, '…', 'UTF-8'); ?>
									</div>
								<?php
	}
?>
							</div>
						<?php
	}
?>
						<?php
	if($img02_Value || $text02_Value){
?>
							<div class="detail-box">
								<?php
	if($img02_Value){
?>
									<p class="detail-img">
										<img src="<?php echo $img02_Src; ?>" alt="<?php echo $title; ?>">
									</p>
								<?php
	}
?>
								<?php
	if($text02_Value){
?>
									<div class="detail-desc">
										<?php echo $text02_Value; ?>
									</div>
								<?php
	}
?>
							</div>
						<?php
	}
?>
						<?php
	if($img03_Value || $text03_Value){
?>
							<div class="detail-box">
								<?php
	if($img03_Value){
?>
									<p class="detail-img">
										<img src="<?php echo $img03_Src; ?>" alt="<?php echo $title; ?>">
									</p>
								<?php
	}
?>
								<?php
	if($text03_Value){
?>
									<div class="detail-desc">
										<?php echo $text03_Value; ?>
									</div>
								<?php
	}
?>
							</div>
						<?php
	}
?>
						<?php
	if($img04_Value || $text04_Value){
?>
							<div class="detail-box">
								<?php
	if($img04_Value){
?>
									<p class="detail-img">
										<img src="<?php echo $img04_Src; ?>" alt="<?php echo $title; ?>">
									</p>
								<?php
	}
?>
								<?php
	if($text04_Value){
?>
									<div class="detail-desc">
										<?php echo $text04_Value; ?>
									</div>
								<?php
	}
?>
							</div>
						<?php
	}
?>
						<?php
	if($img05_Value || $text05_Value){
?>
							<div class="detail-box">
								<?php
	if($img05_Value){
?>
									<p class="detail-img">
										<img src="<?php echo $img05_Src; ?>" alt="<?php echo $title; ?>">
									</p>
								<?php
	}
?>
								<?php
	if($text05_Value){
?>
									<div class="detail-desc">
										<?php echo $text05_Value; ?>
									</div>
								<?php
	}
?>
							</div>
						<?php
	}
?>
						<?php
	if($img06_Value || $text06_Value){
?>
							<div class="detail-box">
								<?php
	if($img06_Value){
?>
									<p class="detail-img">
										<img src="<?php echo $img06_Src; ?>" alt="<?php echo $title; ?>">
									</p>
								<?php
	}
?>
								<?php
	if($text06_Value){
?>
									<div class="detail-desc">
										<?php echo $text06_Value; ?>
									</div>
								<?php
	}
?>
							</div>
						<?php
	}
?>
						<?php
	if($img07_Value || $text07_Value){
?>
							<div class="detail-box">
								<?php
	if($img07_Value){
?>
									<p class="detail-img">
										<img src="<?php echo $img07_Src; ?>" alt="<?php echo $title; ?>">
									</p>
								<?php
	}
?>
								<?php
	if($text07_Value){
?>
									<div class="detail-desc">
										<?php echo $text07_Value; ?>
									</div>
								<?php
	}
?>
							</div>
						<?php
	}
?>
						<?php
	if($img08_Value || $text08_Value){
?>
							<div class="detail-box">
								<?php
	if($img08_Value){
?>
									<p class="detail-img">
										<img src="<?php echo $img08_Src; ?>" alt="<?php echo $title; ?>">
									</p>
								<?php
	}
?>
								<?php
	if($text08_Value){
?>
									<div class="detail-desc">
										<?php echo $text08_Value; ?>
									</div>
								<?php
	}
?>
							</div>
						<?php
	}
?>
						<?php
	if($img09_Value || $text09_Value){
?>
							<div class="detail-box">
								<?php
	if($img09_Value){
?>
									<p class="detail-img">
										<img src="<?php echo $img09_Src; ?>" alt="<?php echo $title; ?>">
									</p>
								<?php
	}
?>
								<?php
	if($text09_Value){
?>
									<div class="detail-desc">
										<?php echo $text09_Value; ?>
									</div>
								<?php
	}
?>
							</div>
						<?php
	}
?>
						<?php
	if($img10_Value || $text10_Value){
?>
							<div class="detail-box">
								<?php
	if($img10_Value){
?>
									<p class="detail-img">
										<img src="<?php echo $img10_Src; ?>" alt="<?php echo $title; ?>">
									</p>
								<?php
	}
?>
								<?php
	if($text10_Value){
?>
									<div class="detail-desc">
										<?php echo $text10_Value; ?>
									</div>
								<?php
	}
?>
							</div>
						<?php
	}
?>
					</div>
				</div>

				<div class="section">
					<div class="btn_prev_next_sec clearfix">
						<?php $current_url = $url; ?>
						<?php
	$contribute_index=contribute_search(
		$current_category_id
		,''
		,''
		,''
		,''
		,''
	);
	$max_record_count=count($contribute_index);

?>
							<?php
	$local_index=0;
	foreach($contribute_index as $rowid=>$index){
		$contribute=unserialize(@file_get_contents(DATA_DIR.'/contribute/'.$index['id'].'.dat'));
		$title=$contribute['title'];
		$url=$contribute['url'].'/';
		$category_id=$index['category'];
		$category_data=unserialize(@file_get_contents(DATA_DIR.'/category/'.$category_id.'.dat'));
		$category_name=$category_data['name'];
		$category_text=@$category_data['text'];
		$field_id=$index['field'];
		$date=$index['public_begin_datetime'];
		$id=$index['id'];
		$field=get_field($field_id);

		foreach($field as $field_index=>$field_data){
			${$field_data['code'].'_Name'}=$field_data['name'];
			${$field_data['code'].'_Value'}=make_value(
		$field_data['name']
				,@$contribute['data'][$field_id][$field_index]
				,$field_data['type']
				,$id
				,$field_id
				,$field_index
			);
	
			if($field_data['type']=='image'){
				${$field_data['code'].'_Src'}=ROOT_URI.'/_data/contribute/images/'.@$contribute['data'][$field_id][$field_index];
			}
		}
		$local_index++;

?>
								<?php $pages[] = $url; ?>
							<?php
		foreach($field as $field_index=>$field_data){
			unset(${$field_data['code'].'_Name'});
			unset(${$field_data['code'].'_Value'});
			unset(${$field_data['code'].'_Src'});
		}
	}
?>
						
						<?php $current_page = array_search($current_url,$pages); ?>
						<ul class="btn_prev_next">
							<?php if($prev = @$pages[$current_page+1]): ?>
							<li class="prevPage"><a href="../<?php echo $prev ?>">&#8592; 前の記事へ</a></li>
							<?php endif; ?>
							<li class="centerPage"><a href="../<?php echo $current_category_url; ?>/">一覧に戻る</a></li>
							<?php if($next = @$pages[$current_page-1]): ?>
							<li class="nextPage"><a href="../<?php echo $next ?>">次の記事へ &#8594;</a></li>
							<?php endif ?>
						</ul>
					</div>
				</div>


			</div>

			<section class="contacts">
				<div class="container">
					<div class="contacts-wrapper">
						<div class="contacts-txt">
							<h3 class="contacts-title">
								<span class="contacts-en">contact</span>
								<span class="contacts-jp">お問い合わせ</span>
							</h3>
							<p class="contacts-desc">
								ご相談、お見積りのご要望など
								お気軽にご連絡ください
							</p>
						</div>
						<div class="contacts-btn">
							<a href="tel:0336598657" onclick="gtag('event', 'tel', {'event_category': 'sp'});"
								class="contacts-tel sweetlink">
								<span class="tls-tt">まずはお話お聞かせください</span>
								<span class="tls-phone">03-3659-8657</span>
								<span class="tls-time">平日8：00-19：00</span>
							</a>
							<a href="../../contact/" class="contacts-email">
								<div class="eml-tx">
									<span class="eml-tt">WEBからの問い合わせ</span>
									<span class="eml-tt2">メールフォームはこちら</span>
								</div>
							</a>
						</div>
					</div>
				</div>
			</section>
			<!-- end #content -->
		</main>
		<!-- end #main -->
		<footer id="footer">
			<div class="footer-mid">
				<div class="container">
					<div class="fm-wrapper">
						<div class="fm-txt">
							<a href="https://www.san-oh-research.jp/" class="fm-logo">
								<img src="../../images/logo-ft.png" width="204" height="134" loading="lazy"
									alt="SANOH 株式会社 三央">
							</a>
							<p class="fm-tx">
								排水管・給水管の<br>
								内視鏡調査
							</p>
							<div class="fm-tell">
								<p class="fm-tell-tt">
									お電話での問い合わせ
								</p>
								<a href="tel:0336598657" onclick="gtag('event', 'tel', {'event_category': 'sp'});"
									class="fm-tell-lk">
									03-3659-8657
								</a>
								<p class="fm-tell-time">
									平日8：00-19：00
								</p>
							</div>

							<a href="../../contact/" class="fm-contact">
								<span class="fm-sm">WEBからの問い合わせ</span>
								<span class="fm-bz">メールフォーム</span>
							</a>
						</div>

						<div class="fm-menu">
							<div class="fm-col">
								<ul class="fm-list">
									<li>
										<a href="https://www.san-oh-research.jp/" class="fm-ar">TOPページ<span
												class="fm-r"></span></a>
									</li>
									<li>
										<span class="fm-ar">事業案内<span class="fm-r"></span></span>
										<ul class="fm-lst">
											<li>
												<a href="../../about/service.html">サービス一覧</a>
											</li>
											<li>
												<a href="../../basic/endoscope.html">排水管・給水管の内視鏡調査</a>
											</li>
											<li>
												<a href="../../basic/endoscope2.html">漏水調査</a>
											</li>
											<li>
												<a href="../../about/waterleak.html">調査機材紹介</a>
											</li>
										</ul>
									</li>
									<li>
										<span class="fm-ar">排水管・給水管の基礎知識<span class="fm-r"></span></span>
										<ul class="fm-lst">
											<li>
												<a href="../../beforetrouble.html">【トラブル前】定期的な調査をしましょう</a>
											</li>
											<li>
												<a href="../../aftertrouble.html">【トラブル後】調査で明確な原因究明</a>
											</li>
											<li>
												<a href="../../basic/drainpipe.html">調査専門会社へ依頼するメリット</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
							<div class="fm-col">
								<ul class="fm-list">
									<li>
										<span class="fm-ar">会社案内<span class="fm-r"></span></span>
										<ul class="fm-lst">
											<li>
												<a href="../../about/company.html">会社概要</a>
											</li>
											<li>
												<a href="../../about/interview.html">代表インタビュー</a>
											</li>
											<li>
												<a href="../../contact/">対応エリア</a>
											</li>
											<li>
												<a href="../../about/faq.html">よくあるご質問</a>
											</li>
											<li>
												<a href="../../about/flow.html">お問い合わせからの流れ</a>
											</li>
										</ul>
									</li>
									<li>
										<a href="../../about/concept.html" class="fm-ar">三央の強み<span
												class="fm-r"></span></a>
									</li>
									<li>
										<a href="../../about/price.html" class="fm-ar">料金表<span class="fm-r"></span></a>
									</li>
								</ul>
							</div>
							<div class="fm-col">
								<ul class="fm-list">
									<li>
										<a href="../../for/owner.html" class="fm-ar">マンション・ビルオーナー様<br>管理組合様へ<span
												class="fm-r"></span></a>
									</li>
									<li>
										<a href="../../for/builder.html" class="fm-ar">建築・設計・<br> 水道工事業者様へ<span
												class="fm-r"></span></a>
									</li>
									<li>
										<a href="../../results/list.html" class="fm-ar">調査実績一覧<span
												class="fm-r"></span></a>
									</li>
									<li>
										<a href="../../report/" class="fm-ar">新着調査レポート<span class="fm-r"></span></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="copyright">Copyright &copy; SANOH All Rights Reserved.</div>
			<div class="scroll-top"></div>
		</footer>
		<!-- end #footer -->
	</div>

	<!-- library -->
	<script src="../../js/libs/jquery.js" type="text/javascript"></script>
	<script src="../../js/libs/sweetlink/sweetlink.js" type="text/javascript"></script>
	<script src="../../js/libs/matchheight/matchHeight.js"></script>

	<!-- Modules -->
	<script src="../../js/modules/common.js" type="text/javascript"></script>

</body>

</html>