<?php
namespace Deployer;
require 'recipe/symfony.php';


// Configuration

set('repository', 'tislars@github.com:tislars/mement.git');

add('shared_files', []);
add('shared_dirs', []);

add('writable_dirs', []);

// Servers

server('production', 'elara.exsilia.net')
    ->user('root')
    ->identityFile()
    ->set('deploy_path', '~/vhosts/mement/httpdocs');


// Tasks

// desc('Restart PHP-FPM service');
// task('php-fpm:restart', function () {
//     // The user must have rights for restart service
//     // /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
//     run('sudo systemctl restart php-fpm.service');
// });
// after('deploy:symlink', 'php-fpm:restart');

// Migrate database before symlink new release.
 
// before('deploy:symlink', 'database:migrate');


task('test', function() {
	writeln('Hello lars!');
});
after('deploy:prepare', 'test');
after('test', 'deploy:unlock');

task('pwd', function () {
    $result = run('pwd');
    writeln("Current dir: $result");
});