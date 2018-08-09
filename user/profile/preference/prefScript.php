<?php
	require_once(__DIR__ . "/../../req/connect.php");
	require_once(__DIR__ . "/../../req/utility.php");
		
	$list = array(	'Secretariat' => array('United States of America','People’s Republic of China','United Kingdom of Great Britain and Northern Ireland','Kingdom of Saudi Arabia','Democratic Republic of Congo','Central African Republic','Republic of Palau','Republic of Italy','Canada','Islamic Republic of Pakistan','Islamic Republic of Iran','Republic of Turkey','People’s Republic of Bangladesh','Federal Democratic Republic of Nepal','Hashemite Kingdom of Jordan','Islamic Republic of Afghanistan','Republic of South Sudan','Republic of Lebanon','Republic of Congo','Republic of Korea'),
	
					'SOCHUM' => array('United Kingdom of Great Britain and Northern Ireland','People’s Republic of China','United States of America','Kingdom of Saudi Arabia','Republic of Turkey','Republic of Kazakhstan','Republic of Argentina','Commonwealth of Australia','Canada','Republic of Italy','Republic of Korea','Republic of Djibouti','Republic of Angola','Republic of Malawi',
										'Republic of Lebanon','Republic of Senegal','Republic of Portugal','Bolivarian Republic of Venezuela','Antigua and Barbuda','Federal Democratic Republic of Nepal','State of Kuwait','Republic of Poland','Libya','State of Israel','Solomon Islands',
											'Republic of Suriname','Democratic Socialist Republic of Sri Lanka','Republic of Cuba','Turkmenistan','Syrian Arab Republic','Republic of Trinidad and Tobago'),
					
					'Legal'=> array('USA','China','UK','Italy','Canada','Australia','Spain','Turkey','Saudia Arabia','South Korea','Argentina','Denmark','New Zealand','Greece','Iran','Netherlands','Serbia','Qatar','Portugal','Philippines'),
					
					'WHO' => array('Argentina','Australia','Canada','Costa Rica','Iran','Israel','Italy','Kosovo','Moldova','Nigeria','People\'s Republic of China','Peru','Phillipines','Red Cross','Republic of Korea','Saudi Arabia','Singapore','Turkey','UAE','United Kingdom','United States of America'),
										
					'UNODC'=> array('USA','People\'s Republic of China','Turkey','Italy','Saudi Arabia','Egypt','Greece','Bulgaria','Tajikistan','Central African Republic','Eritrea','Montenegro','Austria','Poland','Ethiopia','Niger','Mali','Chad','Guinea'),
					
					'UNSC'=> array('Australia','Brazil','Canada','China','Italy','Korea','Norway','Singapore','Sweden','UK','US'),
		
					'IAEA' => array('DPRK','USA','UK','CHINA','CANADA','ITALY','SOUTH KOREA','ARGENTINA','SAUDI ARABIA','TURKEY','AFGHANISTAN','SYRIA','UAE','NORWAY','NEW ZEALAND','POLAND','DENMARK','ICELAND','IRELAND','TANZANIA','SOMALIA','BELARUS','AUSTRIA','SINGAPORE','BELGIUM'),
					
					'Planning Commission'=> array('Division of Finance','Defence Planning Cell','Division of External Affairs','Minister of State Punjab with Independent Charge','Division of Power and Energy','Division of Agriculture','Division of Infrastructure and Planning','Division of Media and Broadcasting','Minister of states of North East with Independent Charge','Division of Health and Welfare'),
					
					'WEF'=> array('Representative of World Bank','Imran Khan','Chair of the Federal Reserve','Representative of the WTO','Mark Zuckerburg','Sundar Pichai','Special representative of the OPEC','Greenpeace representative','Supreme Leader of Iran','Arab League Representative','Nigel Farage','Richard Branson','Steve Forbes'),
					
					'AD-Hoc'=> array('Donald J Trump - President of the United States of America','Representative of Anonymous','Xi Jinping - Chinese Premier','Salman bin Abdulaziz - King of Saudi Arabia','Benjamin Netanyahu - Prime Minister of Israel','Aung San Suu Kyi - State Counselor of Myanmar','Marillyn A Hewson - CEO of Lockheed Martin','HE Paul Kagame - Chair of African Union','Mark E Zuckerberg','Rupert Murdoch'),
					
					'JCC 1' => array('German Field Marshal(Army chief)','Commander of the Navy','Governor General of Ceylon and Chinese Provinces','Chief of General Staff of the Imperial and Royal Army Austria','Karl IV-King of Hungary','Senator Huey Long: Head of America First Party','Nikolai Bukharin :Head of the Mensheviks', 'Russia Head of government :Hüseyin Pasa (Ottoman Empire)' , 'Tsar of Bulgaria','Head of State: Osman Ali Khan (Indian Princely Provinces)','Prime minister Xu Shinchang (Qing Empire)','Representative: Andre Dewavrin (National France)','Huseyin Pasa: Head of Government of Ottoman Empire'),
					
					'JCC 2' => array('Union of Britain','Head of Government: Arthur Horner','Foreign Minister: Clifford Allen','Intelligence Minister: Fenner Brockway','Commune of France','Chairman of the Bourse Générale du Travail: Sébastien Faure','Director of Intelligence: May Picqueray','Socialist republic of Italy','Army: Umberto Marzocchi','COMBINED SYNDICALISTS OF AMERICA','Head of Association: John Reed','Head of Communications: William Foster','SYNDICALIST REPUBLIC OF CHILE','Head of State: Marmaduke Grove','DOMINION OF INDIA','Representative : Veer Singh Rajput','SARDINIA','Representative: Mario Agustelli','RSFSR','Leon Trotsky','PURE KINGDOM UPON THE HEAVENS','Head of State Zhang Tianran'),
					
					'Illuminati'=> array('Carlos Slim','David Jr. Rockefeller','William Astor','Jacob Rothschild','Patrick Reynolds','The Bundy brothers','Elon Musk','Dan Coats, Director of National Inteligance of USA','Queen','Fan Bingbing')
				);
				
	if(isset($_POST['committee'])) {
		if(!empty($_POST['committee'])) {
			$committee = trim($_POST['committee']);
			
			$countries = $list[$committee];			
			$op = "<option>Choose Portfolio</option>";
			foreach($countries as $country) {
				$op .= "<option value='".$country."'>".$country."</option>";
			}
			echo $op;
		}
	}
?>