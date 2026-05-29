php artisan migrate:fresh --seed

# dev
npm run watch

# prod
npm run prod

# run with docker
## connect to vpn
docker compose up --biuld


## cpanel
/app/bootstrap/app.php
$app->usePublicPath($app->basePath('../public_html'));

/public_html/index.php
require __DIR__ . '/../cms/vendor/autoload.php';
$app = require_once __DIR__ . '/../cms/bootstrap/app.php';

/cms/server.php
require_once __DIR__.'/index.php';
