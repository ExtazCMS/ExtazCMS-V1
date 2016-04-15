<?php
class ChartsController extends AppController{

	public $uses = ['Informations', 'shopHistory', 'starpassHistory', 'paypalHistory', 'donationLadder'];
	public $components = ['Highcharts.Highcharts'];

    public function admin_memory(){
		if($this->Auth->user('role') > 1){
    		$api = new JSONAPI($this->config['jsonapi_ip'], $this->config['jsonapi_port'], $this->config['jsonapi_username'], $this->config['jsonapi_password'], $this->config['jsonapi_salt']);
			$usedMemory = round($api->call('server.performance.memory.used')['0']['success']);
			$totalMemory = round($api->call('server.performance.memory.total')['0']['success']) - ($usedMemory);
			$pieData = array(
	            array('Mémoire disponible', $totalMemory),
	            array('Mémoire utilisé', $usedMemory)
	        );
	        $chartName = 'memory_chart';
	        $pieChart = $this->Highcharts->create($chartName, 'pie');
	        $this->Highcharts->setChartParams($chartName, array(
	            'renderTo' => 'memory_chart',
	            'chartWidth' => 650,
	            'chartHeight' => 600,
	            'chartMarginTop' => 60,
	            'chartMarginLeft' => 90,
	            'chartMarginRight' => 30,
	            'chartMarginBottom' => 0,
	            'chartSpacingRight' => 10,
	            'chartSpacingBottom' => 15,
	            'chartSpacingLeft' => 0,
	            'chartAlignTicks' => FALSE,
	            'chartBackgroundColorLinearGradient' => array(255, 255, 255, 255),
	            'chartBackgroundColorStops' => array(array(0, 'rgb(255, 255, 255)'), array(1, 'rgb(255, 255, 255)')),
	            'title' => 'Utilisation de la mémoire vive du serveur (en MB)',
	            'titleAlign' => 'center',
	            'titleFloating' => TRUE,
	            'titleStyleFont' => '18px Metrophobic, Arial, sans-serif',
	            'titleStyleColor' => '#606060',
	            'titleX' => 20,
	            'titleY' => 20,
	            'legendEnabled' => TRUE,
	            'legendLayout' => 'horizontal',
	            'legendAlign' => 'center',
	            'legendVerticalAlign ' => 'bottom',
	            'legendItemStyle' => array('color' => '#222'),
	            'legendBackgroundColorLinearGradient' => array(0, 0, 0, 25),
	            'legendBackgroundColorStops' => array(array(0, '#FFFFFF'), array(1, '#FFFFFF')),
	            'tooltipEnabled' => TRUE,
	            'tooltipBackgroundColorLinearGradient' => array(0, 0, 0, 50),
	            'tooltipBackgroundColorStops' => array(array(0, 'rgb(217, 217, 217)'), array(1, 'rgb(255, 255, 255)')),
	            'creditsEnabled' => FALSE
	            )
	        );
	        $series = $this->Highcharts->addChartSeries();
	        $series->addName('En megabytes (mb)')->addData($pieData);
	        $pieChart->addSeries($series);
	        
	        $this->set(compact('chartName'));
		}
	    else{
	    	throw new NotFoundException();
	    }
	}

	public function admin_donator(){
		if($this->Auth->user('role') > 1){
			$site_money = ucfirst($this->config['site_money']);
			$donatorsTokens = $this->donationLadder->find('all', ['limit' => 5, 'order' => ['donationLadder.tokens' => 'DESC']]);
			$donatorsUsername = $this->donationLadder->find('list', ['fields' => ['donationLadder.id'], 'limit' => 5]);
			$countDonators = $this->donationLadder->find('count');
			$chartName = 'donator_chart';
	        $mychart = $this->Highcharts->create($chartName, 'column');

	        if($countDonators >= 5){
	        	$dt[0] = $donatorsTokens[0]['donationLadder']['tokens'];
		        $dt[1] = $donatorsTokens[1]['donationLadder']['tokens'];
		        $dt[2] = $donatorsTokens[2]['donationLadder']['tokens'];
		        $dt[3] = $donatorsTokens[3]['donationLadder']['tokens'];
		        $dt[4] = $donatorsTokens[4]['donationLadder']['tokens'];
		        settype($dt[0], 'int');
				settype($dt[1], 'int');
				settype($dt[2], 'int');
				settype($dt[3], 'int');
				settype($dt[4], 'int');
	        }
	        else{
		        switch($countDonators){
		        	case 1:
		        		$dt[0] = $donatorsTokens[0]['donationLadder']['tokens'];
		        		settype($dt[0], 'int');
		        		break;

		        	case 2:
		        		$dt[0] = $donatorsTokens[0]['donationLadder']['tokens'];
		        		$dt[1] = $donatorsTokens[1]['donationLadder']['tokens'];
		        		settype($dt[0], 'int');
						settype($dt[1], 'int');
		        		break;

		        	case 3:
		        		$dt[0] = $donatorsTokens[0]['donationLadder']['tokens'];
				        $dt[1] = $donatorsTokens[1]['donationLadder']['tokens'];
				        $dt[2] = $donatorsTokens[2]['donationLadder']['tokens'];
				        settype($dt[0], 'int');
						settype($dt[1], 'int');
						settype($dt[2], 'int');
		        		break;

		        	case 4:
		        		$dt[0] = $donatorsTokens[0]['donationLadder']['tokens'];
				        $dt[1] = $donatorsTokens[1]['donationLadder']['tokens'];
				        $dt[2] = $donatorsTokens[2]['donationLadder']['tokens'];
				        $dt[3] = $donatorsTokens[3]['donationLadder']['tokens'];
				        settype($dt[0], 'int');
						settype($dt[1], 'int');
						settype($dt[2], 'int');
						settype($dt[3], 'int');
		        		break;

		        	default:
		        		$dt[0] = 0;
		        		break;
		        }
		    }

		    if($countDonators >= 5){
	        	$du[0] = $donatorsTokens[0]['User']['username'];
		        $du[1] = $donatorsTokens[1]['User']['username'];
		        $du[2] = $donatorsTokens[2]['User']['username'];
		        $du[3] = $donatorsTokens[3]['User']['username'];
		        $du[4] = $donatorsTokens[4]['User']['username'];
	        }
	        else{
		        switch($countDonators){
		        	case 1:
		        		$du[0] = $donatorsTokens[0]['User']['username'];
		        		break;

		        	case 2:
		        		$du[0] = $donatorsTokens[0]['User']['username'];
		        		$du[1] = $donatorsTokens[1]['User']['username'];
		        		break;

		        	case 3:
		        		$du[0] = $donatorsTokens[0]['User']['username'];
				        $du[1] = $donatorsTokens[1]['User']['username'];
				        $du[2] = $donatorsTokens[2]['User']['username'];
		        		break;

		        	case 4:
		        		$du[0] = $donatorsTokens[0]['User']['username'];
				        $du[1] = $donatorsTokens[1]['User']['username'];
				        $du[2] = $donatorsTokens[2]['User']['username'];
				        $du[3] = $donatorsTokens[3]['User']['username'];
		        		break;

		        	default:
		        		$du[0] = '';
		        		break;
		        }
		    }
		    
			$chartData = $dt;

	        $this->Highcharts->setChartParams($chartName, array(
	            'renderTo' => 'donator_chart',
	            'chartWidth' => 1000,
	            'chartHeight' => 600,
	            'chartMarginTop' => 60,
	            'chartMarginLeft' => 90,
	            'chartMarginRight' => 30,
	            'chartMarginBottom' => 110,
	            'chartSpacingRight' => 10,
	            'chartSpacingBottom' => 15,
	            'chartSpacingLeft' => 0,
	            'chartAlignTicks' => FALSE,
	            'chartBackgroundColorLinearGradient' => array(255, 255, 255, 255),
	            'chartBackgroundColorStops' => array(array(0, 'rgb(255, 255, 255)'), array(1, 'rgb(255, 255, 255)')),
	            'title' => 'Graphique des meilleurs donateurs',
	            'titleAlign' => 'center',
	            'titleFloating' => TRUE,
	            'titleStyleFont' => '18px Metrophobic, Arial, sans-serif',
	            'titleStyleColor' => '#606060',
	            'titleX' => 20,
	            'titleY' => 20,
	            'legendEnabled' => TRUE,
	            'legendLayout' => 'horizontal',
	            'legendAlign' => 'center',
	            'legendVerticalAlign ' => 'bottom',
	            'legendItemStyle' => array('color' => '#222'),
	            'legendBackgroundColorLinearGradient' => array(0, 0, 0, 25),
	            'legendBackgroundColorStops' => array(array(0, '#FFFFFF'), array(1, '#FFFFFF')),
	            'tooltipEnabled' => FALSE,
	            'xAxisLabelsEnabled' => TRUE,
	            'xAxisLabelsAlign' => 'right',
	            'xAxisLabelsStep' => 1,
	            'xAxislabelsX' => 5,
	            'xAxisLabelsY' => 20,
	            'xAxisCategories' => $du,
	            'yAxisTitleText' => FALSE,
	            'enableAutoStep' => FALSE,
	            'creditsEnabled' => FALSE
	            )
	        );

	        $series = $this->Highcharts->addChartSeries();

	        $series->addName($site_money.' achetés')->addData($chartData);

	        $mychart->addSeries($series);
	        
	        $this->set(compact('chartName'));
	    }
	    else{
	    	throw new NotFoundException();
	    }
	}

	public function admin_shop(){
		if($this->Auth->user('role') > 1){
			$chartName = 'shop_chart';
	        $mychart = $this->Highcharts->create($chartName, 'areaspline');

	        $today = 'Ajd';
			$todayMoinsUn = date('j/m', strtotime('-1 day'));
			$todayMoinsDeux = date('j/m', strtotime('-2 day'));
			$todayMoinsTrois = date('j/m', strtotime('-3 day'));
			$todayMoinsQuatre = date('j/m', strtotime('-4 day'));
			$todayMoinsCinq = date('j/m', strtotime('-5 day'));
			$todayMoinsSix = date('j/m', strtotime('-6 day'));
			$todayMoinsSept = date('j/m', strtotime('-7 day'));
			$todayMoinsHuit = date('j/m', strtotime('-8 day'));
			$todayMoinsNeuf = date('j/m', strtotime('-9 day'));
			$todayMoinsDix = date('j/m', strtotime('-10 day'));

			$countToday = date('Y-m-j').' 00:00:00';
			$countTodayMoinsUn = date('Y-m-j', strtotime('-1 day')).' 00:00:00';
			$countTodayMoinsDeux = date('Y-m-j', strtotime('-2 day')).' 00:00:00';
			$countTodayMoinsTrois = date('Y-m-j', strtotime('-3 day')).' 00:00:00';
			$countTodayMoinsQuatre = date('Y-m-j', strtotime('-4 day')).' 00:00:00';
			$countTodayMoinsCinq = date('Y-m-j', strtotime('-5 day')).' 00:00:00';
			$countTodayMoinsSix = date('Y-m-j', strtotime('-6 day')).' 00:00:00';
			$countTodayMoinsSept = date('Y-m-j', strtotime('-7 day')).' 00:00:00';
			$countTodayMoinsHuit = date('Y-m-j', strtotime('-8 day')).' 00:00:00';
			$countTodayMoinsNeuf = date('Y-m-j', strtotime('-9 day')).' 00:00:00';
			$countTodayMoinsDix = date('Y-m-j', strtotime('-10 day')).' 00:00:00';

			$achatsToday = $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $countToday]]);
			$achatsTodayMoinsUn = $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $countTodayMoinsUn, 'shopHistory.created <' => $countToday]]);
			$achatsTodayMoinsDeux = $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $countTodayMoinsDeux, 'shopHistory.created <' => $countTodayMoinsUn]]);
			$achatsTodayMoinsTrois = $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $countTodayMoinsTrois, 'shopHistory.created <' => $countTodayMoinsDeux]]);
			$achatsTodayMoinsQuatre = $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $countTodayMoinsQuatre, 'shopHistory.created <' => $countTodayMoinsTrois]]);
			$achatsTodayMoinsCinq = $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $countTodayMoinsCinq, 'shopHistory.created <' => $countTodayMoinsQuatre]]);
			$achatsTodayMoinsSix = $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $countTodayMoinsSix, 'shopHistory.created <' => $countTodayMoinsCinq]]);
			$achatsTodayMoinsSept = $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $countTodayMoinsSept, 'shopHistory.created <' => $countTodayMoinsSix]]);
			$achatsTodayMoinsHuit = $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $countTodayMoinsHuit, 'shopHistory.created <' => $countTodayMoinsSept]]);
			$achatsTodayMoinsNeuf = $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $countTodayMoinsNeuf, 'shopHistory.created <' => $countTodayMoinsHuit]]);
			$achatsTodayMoinsDix = $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $countTodayMoinsDix, 'shopHistory.created <' => $countTodayMoinsNeuf]]);

			$chartData = [$achatsTodayMoinsDix, $achatsTodayMoinsNeuf, $achatsTodayMoinsHuit, $achatsTodayMoinsSept, $achatsTodayMoinsSix, $achatsTodayMoinsCinq, $achatsTodayMoinsQuatre, $achatsTodayMoinsTrois, $achatsTodayMoinsDeux, $achatsTodayMoinsUn, $achatsToday];

	        $this->Highcharts->setChartParams($chartName, array(
	            'renderTo' => 'shop_chart',
	            'chartWidth' => 1000,
	            'chartHeight' => 600,
	            'chartMarginTop' => 60,
	            'chartMarginLeft' => 90,
	            'chartMarginRight' => 30,
	            'chartMarginBottom' => 110,
	            'chartSpacingRight' => 10,
	            'chartSpacingBottom' => 15,
	            'chartSpacingLeft' => 0,
	            'chartAlignTicks' => FALSE,
	            'chartBackgroundColorLinearGradient' => array(255, 255, 255, 255),
	            'chartBackgroundColorStops' => array(array(0, 'rgb(255, 255, 255)'), array(1, 'rgb(255, 255, 255)')),
	            'title' => 'Graphique des achats boutiques',
	            'titleAlign' => 'center',
	            'titleFloating' => TRUE,
	            'titleStyleFont' => '18px Metrophobic, Arial, sans-serif',
	            'titleStyleColor' => '#606060',
	            'titleX' => 20,
	            'titleY' => 20,
	            'legendEnabled' => TRUE,
	            'legendLayout' => 'horizontal',
	            'legendAlign' => 'center',
	            'legendVerticalAlign ' => 'bottom',
	            'legendItemStyle' => array('color' => '#222'),
	            'legendBackgroundColorLinearGradient' => array(0, 0, 0, 25),
	            'legendBackgroundColorStops' => array(array(0, '#FFFFFF'), array(1, '#FFFFFF')),
	            'tooltipEnabled' => FALSE,
	            'xAxisLabelsEnabled' => TRUE,
	            'xAxisLabelsAlign' => 'right',
	            'xAxisLabelsStep' => 1,
	            'xAxislabelsX' => 5,
	            'xAxisLabelsY' => 20,
	            'xAxisCategories' => array($todayMoinsDix, $todayMoinsNeuf, $todayMoinsHuit, $todayMoinsSept, $todayMoinsSix, $todayMoinsCinq, $todayMoinsQuatre, $todayMoinsTrois, $todayMoinsDeux, $todayMoinsUn, $today),
	            'yAxisTitleText' => FALSE,
	            'enableAutoStep' => FALSE,
	            'creditsEnabled' => FALSE
	            )
	        );

	        $series = $this->Highcharts->addChartSeries();
	        $series->addName('Achats boutique')->addData($chartData);
	        $mychart->addSeries($series);
	        $this->set(compact('chartName'));
	    }
		else{
			throw new NotFoundException();
		}
	}

	public function admin_user(){
		if($this->Auth->user('role') > 1){
			$chartName = 'user_chart';
	        $mychart = $this->Highcharts->create($chartName, 'areaspline');

	        $today = 'Ajd';
			$todayMoinsUn = date('j/m', strtotime('-1 day'));
			$todayMoinsDeux = date('j/m', strtotime('-2 day'));
			$todayMoinsTrois = date('j/m', strtotime('-3 day'));
			$todayMoinsQuatre = date('j/m', strtotime('-4 day'));
			$todayMoinsCinq = date('j/m', strtotime('-5 day'));
			$todayMoinsSix = date('j/m', strtotime('-6 day'));
			$todayMoinsSept = date('j/m', strtotime('-7 day'));
			$todayMoinsHuit = date('j/m', strtotime('-8 day'));
			$todayMoinsNeuf = date('j/m', strtotime('-9 day'));
			$todayMoinsDix = date('j/m', strtotime('-10 day'));

			$countToday = date('Y-m-j').' 00:00:00';
			$countTodayMoinsUn = date('Y-m-j', strtotime('-1 day')).' 00:00:00';
			$countTodayMoinsDeux = date('Y-m-j', strtotime('-2 day')).' 00:00:00';
			$countTodayMoinsTrois = date('Y-m-j', strtotime('-3 day')).' 00:00:00';
			$countTodayMoinsQuatre = date('Y-m-j', strtotime('-4 day')).' 00:00:00';
			$countTodayMoinsCinq = date('Y-m-j', strtotime('-5 day')).' 00:00:00';
			$countTodayMoinsSix = date('Y-m-j', strtotime('-6 day')).' 00:00:00';
			$countTodayMoinsSept = date('Y-m-j', strtotime('-7 day')).' 00:00:00';
			$countTodayMoinsHuit = date('Y-m-j', strtotime('-8 day')).' 00:00:00';
			$countTodayMoinsNeuf = date('Y-m-j', strtotime('-9 day')).' 00:00:00';
			$countTodayMoinsDix = date('Y-m-j', strtotime('-10 day')).' 00:00:00';

			$achatsToday = $this->User->find('count', ['conditions' => ['User.created >' => $countToday]]);
			$achatsTodayMoinsUn = $this->User->find('count', ['conditions' => ['User.created >' => $countTodayMoinsUn, 'User.created <' => $countToday]]);
			$achatsTodayMoinsDeux = $this->User->find('count', ['conditions' => ['User.created >' => $countTodayMoinsDeux, 'User.created <' => $countTodayMoinsUn]]);
			$achatsTodayMoinsTrois = $this->User->find('count', ['conditions' => ['User.created >' => $countTodayMoinsTrois, 'User.created <' => $countTodayMoinsDeux]]);
			$achatsTodayMoinsQuatre = $this->User->find('count', ['conditions' => ['User.created >' => $countTodayMoinsQuatre, 'User.created <' => $countTodayMoinsTrois]]);
			$achatsTodayMoinsCinq = $this->User->find('count', ['conditions' => ['User.created >' => $countTodayMoinsCinq, 'User.created <' => $countTodayMoinsQuatre]]);
			$achatsTodayMoinsSix = $this->User->find('count', ['conditions' => ['User.created >' => $countTodayMoinsSix, 'User.created <' => $countTodayMoinsCinq]]);
			$achatsTodayMoinsSept = $this->User->find('count', ['conditions' => ['User.created >' => $countTodayMoinsSept, 'User.created <' => $countTodayMoinsSix]]);
			$achatsTodayMoinsHuit = $this->User->find('count', ['conditions' => ['User.created >' => $countTodayMoinsHuit, 'User.created <' => $countTodayMoinsSept]]);
			$achatsTodayMoinsNeuf = $this->User->find('count', ['conditions' => ['User.created >' => $countTodayMoinsNeuf, 'User.created <' => $countTodayMoinsHuit]]);
			$achatsTodayMoinsDix = $this->User->find('count', ['conditions' => ['User.created >' => $countTodayMoinsDix, 'User.created <' => $countTodayMoinsNeuf]]);

			$chartData = [$achatsTodayMoinsDix, $achatsTodayMoinsNeuf, $achatsTodayMoinsHuit, $achatsTodayMoinsSept, $achatsTodayMoinsSix, $achatsTodayMoinsCinq, $achatsTodayMoinsQuatre, $achatsTodayMoinsTrois, $achatsTodayMoinsDeux, $achatsTodayMoinsUn, $achatsToday];

	        $this->Highcharts->setChartParams($chartName, array(
	            'renderTo' => 'user_chart',
	            'chartWidth' => 1000,
	            'chartHeight' => 600,
	            'chartMarginTop' => 60,
	            'chartMarginLeft' => 90,
	            'chartMarginRight' => 30,
	            'chartMarginBottom' => 110,
	            'chartSpacingRight' => 10,
	            'chartSpacingBottom' => 15,
	            'chartSpacingLeft' => 0,
	            'chartAlignTicks' => FALSE,
	            'chartBackgroundColorLinearGradient' => array(255, 255, 255, 255),
	            'chartBackgroundColorStops' => array(array(0, 'rgb(255, 255, 255)'), array(1, 'rgb(255, 255, 255)')),
	            'title' => 'Graphique des utilisateurs inscrits',
	            'titleAlign' => 'center',
	            'titleFloating' => TRUE,
	            'titleStyleFont' => '18px Metrophobic, Arial, sans-serif',
	            'titleStyleColor' => '#606060',
	            'titleX' => 20,
	            'titleY' => 20,
	            'legendEnabled' => TRUE,
	            'legendLayout' => 'horizontal',
	            'legendAlign' => 'center',
	            'legendVerticalAlign ' => 'bottom',
	            'legendItemStyle' => array('color' => '#222'),
	            'legendBackgroundColorLinearGradient' => array(0, 0, 0, 25),
	            'legendBackgroundColorStops' => array(array(0, '#FFFFFF'), array(1, '#FFFFFF')),
	            'tooltipEnabled' => FALSE,
	            'xAxisLabelsEnabled' => TRUE,
	            'xAxisLabelsAlign' => 'right',
	            'xAxisLabelsStep' => 1,
	            'xAxislabelsX' => 5,
	            'xAxisLabelsY' => 20,
	            'xAxisCategories' => array($todayMoinsDix, $todayMoinsNeuf, $todayMoinsHuit, $todayMoinsSept, $todayMoinsSix, $todayMoinsCinq, $todayMoinsQuatre, $todayMoinsTrois, $todayMoinsDeux, $todayMoinsUn, $today),
	            'yAxisTitleText' => FALSE,
	            'enableAutoStep' => FALSE,
	            'creditsEnabled' => FALSE
	            )
	        );

	        $series = $this->Highcharts->addChartSeries();
	        $series->addName('Utilisateurs inscrits')->addData($chartData);
	        $mychart->addSeries($series);
	        $this->set(compact('chartName'));
	    }
		else{
			throw new NotFoundException();
		}
	}

	public function admin_paypal(){
		if($this->Auth->user('role') > 1){
			$chartName = 'paypal_chart';
	        $mychart = $this->Highcharts->create($chartName, 'areaspline');

	        $today = 'Ajd';
			$todayMoinsUn = date('j/m', strtotime('-1 day'));
			$todayMoinsDeux = date('j/m', strtotime('-2 day'));
			$todayMoinsTrois = date('j/m', strtotime('-3 day'));
			$todayMoinsQuatre = date('j/m', strtotime('-4 day'));
			$todayMoinsCinq = date('j/m', strtotime('-5 day'));
			$todayMoinsSix = date('j/m', strtotime('-6 day'));
			$todayMoinsSept = date('j/m', strtotime('-7 day'));
			$todayMoinsHuit = date('j/m', strtotime('-8 day'));
			$todayMoinsNeuf = date('j/m', strtotime('-9 day'));
			$todayMoinsDix = date('j/m', strtotime('-10 day'));

			$countToday = date('Y-m-j').' 00:00:00';
			$countTodayMoinsUn = date('Y-m-j', strtotime('-1 day')).' 00:00:00';
			$countTodayMoinsDeux = date('Y-m-j', strtotime('-2 day')).' 00:00:00';
			$countTodayMoinsTrois = date('Y-m-j', strtotime('-3 day')).' 00:00:00';
			$countTodayMoinsQuatre = date('Y-m-j', strtotime('-4 day')).' 00:00:00';
			$countTodayMoinsCinq = date('Y-m-j', strtotime('-5 day')).' 00:00:00';
			$countTodayMoinsSix = date('Y-m-j', strtotime('-6 day')).' 00:00:00';
			$countTodayMoinsSept = date('Y-m-j', strtotime('-7 day')).' 00:00:00';
			$countTodayMoinsHuit = date('Y-m-j', strtotime('-8 day')).' 00:00:00';
			$countTodayMoinsNeuf = date('Y-m-j', strtotime('-9 day')).' 00:00:00';
			$countTodayMoinsDix = date('Y-m-j', strtotime('-10 day')).' 00:00:00';

			$achatsToday = $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $countToday]]);
			$achatsTodayMoinsUn = $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $countTodayMoinsUn, 'paypalHistory.created <' => $countToday]]);
			$achatsTodayMoinsDeux = $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $countTodayMoinsDeux, 'paypalHistory.created <' => $countTodayMoinsUn]]);
			$achatsTodayMoinsTrois = $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $countTodayMoinsTrois, 'paypalHistory.created <' => $countTodayMoinsDeux]]);
			$achatsTodayMoinsQuatre = $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $countTodayMoinsQuatre, 'paypalHistory.created <' => $countTodayMoinsTrois]]);
			$achatsTodayMoinsCinq = $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $countTodayMoinsCinq, 'paypalHistory.created <' => $countTodayMoinsQuatre]]);
			$achatsTodayMoinsSix = $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $countTodayMoinsSix, 'paypalHistory.created <' => $countTodayMoinsCinq]]);
			$achatsTodayMoinsSept = $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $countTodayMoinsSept, 'paypalHistory.created <' => $countTodayMoinsSix]]);
			$achatsTodayMoinsHuit = $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $countTodayMoinsHuit, 'paypalHistory.created <' => $countTodayMoinsSept]]);
			$achatsTodayMoinsNeuf = $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $countTodayMoinsNeuf, 'paypalHistory.created <' => $countTodayMoinsHuit]]);
			$achatsTodayMoinsDix = $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $countTodayMoinsDix, 'paypalHistory.created <' => $countTodayMoinsNeuf]]);

			$chartData = [$achatsTodayMoinsDix, $achatsTodayMoinsNeuf, $achatsTodayMoinsHuit, $achatsTodayMoinsSept, $achatsTodayMoinsSix, $achatsTodayMoinsCinq, $achatsTodayMoinsQuatre, $achatsTodayMoinsTrois, $achatsTodayMoinsDeux, $achatsTodayMoinsUn, $achatsToday];

	        $this->Highcharts->setChartParams($chartName, array(
	            'renderTo' => 'paypal_chart',
	            'chartWidth' => 1000,
	            'chartHeight' => 600,
	            'chartMarginTop' => 60,
	            'chartMarginLeft' => 90,
	            'chartMarginRight' => 30,
	            'chartMarginBottom' => 110,
	            'chartSpacingRight' => 10,
	            'chartSpacingBottom' => 15,
	            'chartSpacingLeft' => 0,
	            'chartAlignTicks' => FALSE,
	            'chartBackgroundColorLinearGradient' => array(255, 255, 255, 255),
	            'chartBackgroundColorStops' => array(array(0, 'rgb(255, 255, 255)'), array(1, 'rgb(255, 255, 255)')),
	            'title' => 'Graphique des achats PayPal',
	            'titleAlign' => 'center',
	            'titleFloating' => TRUE,
	            'titleStyleFont' => '18px Metrophobic, Arial, sans-serif',
	            'titleStyleColor' => '#606060',
	            'titleX' => 20,
	            'titleY' => 20,
	            'legendEnabled' => TRUE,
	            'legendLayout' => 'horizontal',
	            'legendAlign' => 'center',
	            'legendVerticalAlign ' => 'bottom',
	            'legendItemStyle' => array('color' => '#222'),
	            'legendBackgroundColorLinearGradient' => array(0, 0, 0, 25),
	            'legendBackgroundColorStops' => array(array(0, 'rgb(217, 217, 217)'), array(1, 'rgb(255, 255, 255)')),
	            'tooltipEnabled' => FALSE,
	            'xAxisLabelsEnabled' => TRUE,
	            'xAxisLabelsAlign' => 'right',
	            'xAxisLabelsStep' => 1,
	            'xAxislabelsX' => 5,
	            'xAxisLabelsY' => 20,
	            'xAxisCategories' => array($todayMoinsDix, $todayMoinsNeuf, $todayMoinsHuit, $todayMoinsSept, $todayMoinsSix, $todayMoinsCinq, $todayMoinsQuatre, $todayMoinsTrois, $todayMoinsDeux, $todayMoinsUn, $today),
	            'yAxisTitleText' => FALSE,
	            'enableAutoStep' => FALSE,
	            'creditsEnabled' => FALSE
	            )
	        );

	        $series = $this->Highcharts->addChartSeries();
	        $series->addName('Achats Paypal')->addData($chartData);
	        $mychart->addSeries($series);
	        $this->set(compact('chartName'));
	    }
		else{
			throw new NotFoundException();
		}
	}

	public function admin_starpass(){
		if($this->Auth->user('role') > 1){
			$chartName = 'starpass_chart';
	        $mychart = $this->Highcharts->create($chartName, 'areaspline');

	        $today = 'Ajd';
			$todayMoinsUn = date('j/m', strtotime('-1 day'));
			$todayMoinsDeux = date('j/m', strtotime('-2 day'));
			$todayMoinsTrois = date('j/m', strtotime('-3 day'));
			$todayMoinsQuatre = date('j/m', strtotime('-4 day'));
			$todayMoinsCinq = date('j/m', strtotime('-5 day'));
			$todayMoinsSix = date('j/m', strtotime('-6 day'));
			$todayMoinsSept = date('j/m', strtotime('-7 day'));
			$todayMoinsHuit = date('j/m', strtotime('-8 day'));
			$todayMoinsNeuf = date('j/m', strtotime('-9 day'));
			$todayMoinsDix = date('j/m', strtotime('-10 day'));

			$countToday = date('Y-m-j').' 00:00:00';
			$countTodayMoinsUn = date('Y-m-j', strtotime('-1 day')).' 00:00:00';
			$countTodayMoinsDeux = date('Y-m-j', strtotime('-2 day')).' 00:00:00';
			$countTodayMoinsTrois = date('Y-m-j', strtotime('-3 day')).' 00:00:00';
			$countTodayMoinsQuatre = date('Y-m-j', strtotime('-4 day')).' 00:00:00';
			$countTodayMoinsCinq = date('Y-m-j', strtotime('-5 day')).' 00:00:00';
			$countTodayMoinsSix = date('Y-m-j', strtotime('-6 day')).' 00:00:00';
			$countTodayMoinsSept = date('Y-m-j', strtotime('-7 day')).' 00:00:00';
			$countTodayMoinsHuit = date('Y-m-j', strtotime('-8 day')).' 00:00:00';
			$countTodayMoinsNeuf = date('Y-m-j', strtotime('-9 day')).' 00:00:00';
			$countTodayMoinsDix = date('Y-m-j', strtotime('-10 day')).' 00:00:00';

			$achatsToday = $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $countToday]]);
			$achatsTodayMoinsUn = $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $countTodayMoinsUn, 'starpassHistory.created <' => $countToday]]);
			$achatsTodayMoinsDeux = $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $countTodayMoinsDeux, 'starpassHistory.created <' => $countTodayMoinsUn]]);
			$achatsTodayMoinsTrois = $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $countTodayMoinsTrois, 'starpassHistory.created <' => $countTodayMoinsDeux]]);
			$achatsTodayMoinsQuatre = $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $countTodayMoinsQuatre, 'starpassHistory.created <' => $countTodayMoinsTrois]]);
			$achatsTodayMoinsCinq = $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $countTodayMoinsCinq, 'starpassHistory.created <' => $countTodayMoinsQuatre]]);
			$achatsTodayMoinsSix = $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $countTodayMoinsSix, 'starpassHistory.created <' => $countTodayMoinsCinq]]);
			$achatsTodayMoinsSept = $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $countTodayMoinsSept, 'starpassHistory.created <' => $countTodayMoinsSix]]);
			$achatsTodayMoinsHuit = $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $countTodayMoinsHuit, 'starpassHistory.created <' => $countTodayMoinsSept]]);
			$achatsTodayMoinsNeuf = $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $countTodayMoinsNeuf, 'starpassHistory.created <' => $countTodayMoinsHuit]]);
			$achatsTodayMoinsDix = $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $countTodayMoinsDix, 'starpassHistory.created <' => $countTodayMoinsNeuf]]);

			$chartData = [$achatsTodayMoinsDix, $achatsTodayMoinsNeuf, $achatsTodayMoinsHuit, $achatsTodayMoinsSept, $achatsTodayMoinsSix, $achatsTodayMoinsCinq, $achatsTodayMoinsQuatre, $achatsTodayMoinsTrois, $achatsTodayMoinsDeux, $achatsTodayMoinsUn, $achatsToday];

	        $this->Highcharts->setChartParams($chartName, array(
	            'renderTo' => 'starpass_chart',
	            'chartWidth' => 1000,
	            'chartHeight' => 600,
	            'chartMarginTop' => 60,
	            'chartMarginLeft' => 90,
	            'chartMarginRight' => 30,
	            'chartMarginBottom' => 110,
	            'chartSpacingRight' => 10,
	            'chartSpacingBottom' => 15,
	            'chartSpacingLeft' => 0,
	            'chartAlignTicks' => FALSE,
	            'chartBackgroundColorLinearGradient' => array(255, 255, 255, 255),
	            'chartBackgroundColorStops' => array(array(0, 'rgb(255, 255, 255)'), array(1, 'rgb(255, 255, 255)')),
	            'title' => 'Graphique des achats Starpass',
	            'titleAlign' => 'center',
	            'titleFloating' => TRUE,
	            'titleStyleFont' => '18px Metrophobic, Arial, sans-serif',
	            'titleStyleColor' => '#606060',
	            'titleX' => 20,
	            'titleY' => 20,
	            'legendEnabled' => TRUE,
	            'legendLayout' => 'horizontal',
	            'legendAlign' => 'center',
	            'legendVerticalAlign ' => 'bottom',
	            'legendItemStyle' => array('color' => '#222'),
	            'legendBackgroundColorLinearGradient' => array(0, 0, 0, 25),
	            'legendBackgroundColorStops' => array(array(0, 'rgb(217, 217, 217)'), array(1, 'rgb(255, 255, 255)')),
	            'tooltipEnabled' => FALSE,
	            'xAxisLabelsEnabled' => TRUE,
	            'xAxisLabelsAlign' => 'right',
	            'xAxisLabelsStep' => 1,
	            'xAxislabelsX' => 5,
	            'xAxisLabelsY' => 20,
	            'xAxisCategories' => array($todayMoinsDix, $todayMoinsNeuf, $todayMoinsHuit, $todayMoinsSept, $todayMoinsSix, $todayMoinsCinq, $todayMoinsQuatre, $todayMoinsTrois, $todayMoinsDeux, $todayMoinsUn, $today),
	            'yAxisTitleText' => FALSE,
	            'enableAutoStep' => FALSE,
	            'creditsEnabled' => FALSE
	            )
	        );

	        $series = $this->Highcharts->addChartSeries();
	        $series->addName('Achats Starpass')->addData($chartData);
	        $mychart->addSeries($series);
	        $this->set(compact('chartName'));
	    }
		else{
			throw new NotFoundException();
		}
	}

	public function admin_disk(){
		if($this->Auth->user('role') > 1){
    		$api = new JSONAPI($this->config['jsonapi_ip'], $this->config['jsonapi_port'], $this->config['jsonapi_username'], $this->config['jsonapi_password'], $this->config['jsonapi_salt']);
			$totalMemory = round($api->call('server.performance.disk.free')['0']['success']);
			$usedMemory = round($api->call('server.performance.disk.used')['0']['success']);
			$pieData = array(
	            array('Espace disponible', $totalMemory),
	            array('Espace utilisé', $usedMemory)
	        );
	        $chartName = 'disk_chart';
	        $pieChart = $this->Highcharts->create($chartName, 'pie');
	        $this->Highcharts->setChartParams($chartName, array(
	            'renderTo' => 'disk_chart',
	            'chartWidth' => 650,
	            'chartHeight' => 600,
	            'chartMarginTop' => 60,
	            'chartMarginLeft' => 90,
	            'chartMarginRight' => 30,
	            'chartMarginBottom' => 0,
	            'chartSpacingRight' => 10,
	            'chartSpacingBottom' => 15,
	            'chartSpacingLeft' => 0,
	            'chartAlignTicks' => FALSE,
	            'chartBackgroundColorLinearGradient' => array(255, 255, 255, 255),
	            'chartBackgroundColorStops' => array(array(0, 'rgb(255, 255, 255)'), array(1, 'rgb(255, 255, 255)')),
	            'title' => 'Utilisation de l\'espace disque du serveur (en MB)',
	            'titleAlign' => 'center',
	            'titleFloating' => TRUE,
	            'titleStyleFont' => '18px Metrophobic, Arial, sans-serif',
	            'titleStyleColor' => '#606060',
	            'titleX' => 20,
	            'titleY' => 20,
	            'legendEnabled' => TRUE,
	            'legendLayout' => 'horizontal',
	            'legendAlign' => 'center',
	            'legendVerticalAlign ' => 'bottom',
	            'legendItemStyle' => array('color' => '#222'),
	            'legendBackgroundColorLinearGradient' => array(0, 0, 0, 25),
	            'legendBackgroundColorStops' => array(array(0, '#FFFFFF'), array(1, '#FFFFFF')),
	            'tooltipEnabled' => TRUE,
	            'tooltipBackgroundColorLinearGradient' => array(0, 0, 0, 50),
	            'tooltipBackgroundColorStops' => array(array(0, 'rgb(217, 217, 217)'), array(1, 'rgb(255, 255, 255)')),
	            'creditsEnabled' => FALSE
	            )
	        );
	        $series = $this->Highcharts->addChartSeries();
	        $series->addName('En megabytes')->addData($pieData);
	        $pieChart->addSeries($series);
	        
	        $this->set(compact('chartName'));
		}
	    else{
	    	throw new NotFoundException();
	    }
	}
}