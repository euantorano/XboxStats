<?php
/**
 * A simple library to fetch details about an Xbox user's basic stats via their gamertag.
 *
 * @category  Libraries
 * @package   XboxStats
 * @author    Euan T. <euan@euantor.com>
 * @license   http://opensource.org/licenses/mit-license.php The MIT License
 * @version   1.00
 * @link      http://euantor.com/xboxstats
 */

namespace euantor;

/**
 * Xbox Stats
 */
class XboxStats
{
    /**
     * The base URL of the XBL Gamercard.
     */
    const GAMERCARD_URL = 'http://gamercard.xbox.com/en-US/%s.card';

    /**
     * The current gamertag who's stats are being fetched.
     *
     * @var String
     * @access protected
     */
    protected $gamertag;

    /**
     * An associative array of fetched gamercard HTML.
     *
     * @var Array
     */
    protected $gamercard;

    /**
     * The stats for the current gamertag.
     *
     * @var Array
     * @access public
     */
    public $stats;

    /**
     * Set the gamertag to fetch stats for.
     *
     * @param string $tag The gamertag. Trimmed to 15 characters if it exceeds that limit and URL encoded ready for stat fetching.
     *
     * @return Object The current instance of XboxStats
     */
    public function setGamertag($tag = '')
    {
        $tag = trim($tag);
        $tag = substr($tag, 0, 15);
        $tag = rawurlencode($tag);
        $this->gamertag = $tag;

        return $this;
    }

    /**
     * Fetch the stats
     *
     * @return Array The actual formatted stats
     */
    public function getStats()
    {
        if (empty($this->gamertag)) {
            throw new \Exception('No gamertag set. Please set one using setGamertag()', 1);
        }

        if (!isset($this->gamercard[$this->gamertag])) {
            $doc = new \DOMDocument();
            $doc->validateOnParse = true;
            if (!$doc->loadHTMLFile(sprintf(self::GAMERCARD_URL, $this->gamertag))) {
                throw new \Exception('Could not load stats.', 1);
            }
            $this->gamercard[$this->gamertag] = $doc->saveHTML();
            unset($doc);
        }

        return $this->parseStats();
    }

    /**
     * Parse the actual HTML fetched by getStats().
     *
     * @return Array The player's statistics
     */
    private function parseStats()
    {
        if (!isset($this->stats[$this->gamertag])) {
            if (isset($this->gamercard[$this->gamertag])) {
                $doc = new \DOMDocument();
                $doc->loadHTML($this->gamercard[$this->gamertag]);
            } else {
                throw new \Exception('You must first run getStats()', 1);
            }

            $domXPath = new \DOMXPath($doc);

            $player = [
                'gamertag'   => $domXPath->query("//a[@id='Gamertag']")->item(0)->nodeValue,
                'gamerpic'   => $domXPath->query("//img[@id='Gamerpic']/@src")->item(0)->nodeValue,
                'gamerscore' => (int) $domXPath->query("//div[@id='Gamerscore']")->item(0)->nodeValue,
                'location'   => $domXPath->query("//div[@id='Location']")->item(0)->nodeValue,
                'motto'      => $domXPath->query("//div[@id='Motto']")->item(0)->nodeValue,
                'bio'        => $domXPath->query("//div[@id='Bio']")->item(0)->nodeValue,
                'name'       => $domXPath->query("//div[@id='Name']")->item(0)->nodeValue,
                'rep'        => ($domXPath->query("//div[@class='RepContainer']/div[@class='Star Full']")->length) + ($domXPath->query("//div[@class='RepContainer']/div[@class='Star Half']")->length / 2),
            ];

            $other = $domXPath->evaluate("string(//div[contains(@class, 'XbcGamercard')]/@class)");
            $other = explode(" ", $other);

            $player['subscription'] = $other[1];
            $player['gender']          = $other[2];

            date_default_timezone_set('Europe/London');

            for ($i = 1; $i <= 5; $i++) {
                $player['games'][$i] = [
                    'image'                 => $domXPath->query(".//*[@id='PlayedGames']/li[".$i."]/a/img/@src")->item(0)->nodeValue,
                    'title'                 => $domXPath->query(".//ol[@id='PlayedGames']/li[".$i."]/a/span[@class='Title']")->item(0)->nodeValue,
                    'lastPlayed'            => strtotime($domXPath->query(".//ol[@id='PlayedGames']/li[".$i."]/a/span[@class='LastPlayed']")->item(0)->nodeValue),
                    'earnedGamerscore'      => $domXPath->query(".//ol[@id='PlayedGames']/li[".$i."]/a/span[@class='EarnedGamerscore']")->item(0)->nodeValue,
                    'availableGamerscore'   => $domXPath->query(".//ol[@id='PlayedGames']/li[".$i."]/a/span[@class='AvailableGamerscore']")->item(0)->nodeValue,
                    'earnedAchievements'    => $domXPath->query(".//ol[@id='PlayedGames']/li[".$i."]/a/span[@class='EarnedAchievements']")->item(0)->nodeValue,
                    'availableAchievements' => $domXPath->query(".//ol[@id='PlayedGames']/li[".$i."]/a/span[@class='AvailableAchievements']")->item(0)->nodeValue,
                    'completion'            => $domXPath->query(".//ol[@id='PlayedGames']/li[".$i."]/a/span[@class='PercentageComplete']")->item(0)->nodeValue,
                ];
            }

            $this->stats[$this->gamertag] = $player;
        }

        return $this->stats[$this->gamertag];
    }
}
