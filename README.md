<h1>Parser RSS</h1>

<h2>How to run local</h2>
<ul>
<li>clone project</li>
<li>cd /rss-parser</li>
<li>mv .env .env.example</li>
<li>configure ports, mysql db, link for parsing rss</li>
<li>./vendor/bin/sail up -d</li>
<li>./vendor/bin/sail artisan parse:lifehacker</li>
<li>run parser with command </li>
</ul>

<h2>About packages</h2>
<p>RSS parsed with <b>willvincent/feeds</b> package</p>
<p>Dockerized by Laravel <b>laravel/sail</b> package</p>
<p>Swaggerable json created with <b>zircote/swagger-php</b> package</p>

<h2>About realisation</h2>
<h3>Parser</h3>
<p>RSS parser was created like command for convenience to run from command line etc. </p>
<p>Command added to Kernel, so <b>artisan schedule:run</b> can be used.</p>
<h3>Models</h3>
<p>In project presented <b>Post</b> and <b>Category</b> models.</p>
<p>Models have many-to-many relation with pivot table <b>category_post</b>.</p>
<h3>API</h3>
<p>API done with <b>Route::apiResource</b> in PostController class.</p>
<p>Additional Search request added manually to api.php.</p>
<h3>Documentation</h3>
<p>Json data for swagger available on url docs/json and parsed by Swagger interface on port,
that configurated in .env</p>
<h3>Docker and deploying</h3>
<p>Containers for laravel app, mysql and swagger was created with sail and 
configurated in <b>docker-compose.yml</b>.</p>
<p>App was deploying on heroku, but have not free mysql instances, as i now, so it not work</p>
<p>link <a href="https://app-1299301.herokuapp.com/">https://app-1299301.herokuapp.com/</a></p>
<h3>To do</h3>
<ul>
<li>add doc for all requests</li>
<li>add requests and resources</li>
<li>change category attaching from post method to observer</li>
<li>move all configs from docker-compose.yml to .env</li>
</ul>
<span>if you read here - thanks 🤘</span>
