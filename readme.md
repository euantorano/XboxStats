Xbox Stats
==========

This is a simple class to fetch some basic information about an Xbox Live profile using the user's gamertag. This class uses Microsoft's gamercard service to fetch stats and as such only returns minimal information relating to the player. A full example of the information returned can be seen below. Currently there is no option to selectively fetch information but this is a planned feature.

Usage
=====

**Code:**

	require 'src/Euantor/XboxStats.php';
	$xbox = new euantor\XboxStats;

	var_dump($xbox->setGamertag('etorano')->getStats());

**Output:**

	array (size=11)
		'gamertag' => string 'etorano' (length=7)
		'gamerpic' => string 'http://avatar.xboxlive.com/avatar/etorano/avatarpic-l.png' (length=57)
		'gamerscore' => int 13555
		'location' => string 'England' (length=7)
		'motto' => string '' (length=0)
		'bio' => string '' (length=0)
		'name' => string 'Euan' (length=4)
		'rep' => int 5
		'subscription' => string 'Gold' (length=4)
		'gender' => string 'Male' (length=4)
		'games' =>
			array (size=5)
				1 =>
					array (size=8)
						'image' => string 'http://tiles.xbox.com/tiles/Fb/Ys/02dsb2JhbA9ECgQNGwEfV1pTL2ljb24vMC84MDAwIAAAAAAAAPwDtgo=.jpg' (length=94)
						'title' => string 'Battlefield 3' (length=13)
						'lastPlayed' => int 1350687600
						'earnedGamerscore' => string '825' (length=3)
						'availableGamerscore' => string '1360' (length=4)
						'earnedAchievements' => string '34' (length=2)
						'availableAchievements' => string '53' (length=2)
						'completion' => string '64%' (length=3)
				2 =>
					array (size=8)
						'image' => string 'http://tiles.xbox.com/tiles/RX/0w/1Wdsb2JhbA9ECgQJGgYfVlpWL2ljb24vMC84MDAwIAAAAAAAAPoffVo=.jpg' (length=94)
						'title' => string 'Call of Duty Black Ops' (length=22)
						'lastPlayed' => int 1350601200
						'earnedGamerscore' => string '285' (length=3)
						'availableGamerscore' => string '1700' (length=4)
						'earnedAchievements' => string '19' (length=2)
						'availableAchievements' => string '71' (length=2)
						'completion' => string '26%' (length=3)
				3 =>
					array (size=8)
						'image' => string 'http://tiles.xbox.com/tiles/d1/CI/1Wdsb2JhbA9ECgRcGgMfVloBL2ljb24vMC84MDAwIAAAAAAAAPqnUGg=.jpg' (length=94)
						'title' => string 'Halo: Reach' (length=11)
						'lastPlayed' => int 1350169200
						'earnedGamerscore' => string '415' (length=3)
						'availableGamerscore' => string '1700' (length=4)
						'earnedAchievements' => string '31' (length=2)
						'availableAchievements' => string '69' (length=2)
						'completion' => string '44%' (length=3)
				4 =>
					array (size=8)
						'image' => string 'http://tiles.xbox.com/tiles/YS/ko/0mdsb2JhbA9ECgRcGgMfWQpVL2ljb24vMC84MDAwIAAAAAAAAP0HKX4=.jpg' (length=94)
						'title' => string 'Halo 3' (length=6)
						'lastPlayed' => int 1349996400
						'earnedGamerscore' => string '420' (length=3)
						'availableGamerscore' => string '1750' (length=4)
						'earnedAchievements' => string '23' (length=2)
						'availableAchievements' => string '79' (length=2)
						'completion' => string '29%' (length=3)
				5 =>
					array (size=8)
						'image' => string 'http://tiles.xbox.com/tiles/Rt/BZ/0Gdsb2JhbA9ECgRcGgMfVlhUL2ljb24vMC84MDAwIAAAAAAAAP920Fk=.jpg' (length=94)
						'title' => string 'Halo 3: ODST' (length=12)
						'lastPlayed' => int 1349996400
						'earnedGamerscore' => string '475' (length=3)
						'availableGamerscore' => string '1000' (length=4)
						'earnedAchievements' => string '23' (length=2)
						'availableAchievements' => string '47' (length=2)
						'completion' => string '48%' (length=3)