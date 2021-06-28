<?php

namespace App;

use PDO;
use Exception;

class SitemapGenerator
{
   public $connection;

   public function __construct()
   {
      $this->connection = new PDO('' . DB['driver'] . ':host=' . DB['host'] . ';dbname=' . DB['database'] . ';charset=' . DB['charset'] . '', DB['username'], DB['password']);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

      return $this->create();
   }


   protected function allPages()
   {
      $sqlCode = "SELECT * FROM app_sitemap";
      $queries = $this->connection->prepare($sqlCode);
      $queries->execute();
      $dataList = $queries->fetchAll(PDO::FETCH_ASSOC);
      $totalRow = $queries->rowCount();

      if ($totalRow > 0) {
         return $dataList;
      } else {
         return 0;
      }
   }


   protected function sitemapGenerateUsingDatabase()
   {
      header("Content-Type: application/xml; charset=utf-8");
      $siteMap = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
      $siteMap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;
      foreach ($this->allPages() as $each) {
			$priority = !empty($each['priority']) ? $each['priority'] : 0.80;
         $siteMap .= '<url>' . PHP_EOL;
         if ($each['page_url'] == 'index.php') {
            $siteMap .= '<loc>' . APP . '</loc>' . PHP_EOL;
         } else {
            $explode = explode('.', $each['page_url']);
            $siteMap .= '<loc>' . APP . $explode[0] . '/' . '</loc>' . PHP_EOL;
         }
         $siteMap .= '<lastmod>'. date("c") .'</lastmod>' . PHP_EOL;
         $siteMap .= '<priority>'. $priority .'</priority>' . PHP_EOL;
         $siteMap .= '</url>' . PHP_EOL;
      }
      $siteMap .= '</urlset>' . PHP_EOL;

      return $siteMap;
   }


   protected function create()
   {
      try {
         if (file_put_contents('storage/sitemap.xml', $this->sitemapGenerateUsingDatabase())) {
            echo 'Sitemap Generated Successfully';
         } else {
            throw new Exception('Oops! Something went wrong');
         }
      } catch (Exception $e) {
         return $e->getMessage();
      }
   }
}
