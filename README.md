### XML Sitemap in PHP

--- 
Generate a XML sitemap dynamically using PHP from database. Here you could fine the sitemap.xml file in `storage` directory for testing purpose as well. And make sure that, for your real-time application please avoid `storage` directory for indexing.


### Usage:

---
- Define your database in `app/config.php`

<br>

```sql
[comment]: <> (Database Structure)

CREATE TABLE IF NOT EXISTS `app_sitemap` (
   `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
   `page_url` varchar(255) NOT NULL,
   `priority` double NOT NULL,
   `keywords` text NOT NULL,
   `description` varchar(255) NULL,
   `created_at` datetime NULL,
   `updated_at` datetime NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci AUTO_INCREMENT=1;
```


```bash
$ php index.php
```

```php
require_once 'app/config.php';
require_once 'app/SitemapGenerator.php';

use App\SitemapGenerator;

$map = new SitemapGenerator;
```