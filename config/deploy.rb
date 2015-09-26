require 'capistrano/php'

set :application, "eventbrite-api"
set :repository,  'git@github.com:CacheMakers/eventbrite-api.git'
set :deploy_to, '~/wp-plugins/eventbrite-api'
set :user, "joel"
default_run_options[:pty] = true 
ssh_options[:keys] = [File.join(ENV["HOME"], ".ssh", "id_rsa")]
ssh_options[:port] = 7200
set :use_sudo, false
ssh_options[:forward_agent] = true
set :branch, fetch(:branch, "cachemakers")
set :env, fetch(:env, "production")

# set :scm, :git # You can set :scm explicitly or Capistrano will make an intelligent guess based on known version control directory names
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `git`, `mercurial`, `perforce`, `subversion` or `none`

role :web, "cachemakers.usu.edu"                          # Your HTTP server, Apache/etc
role :app, "cachemakers.usu.edu"                          # This may be the same as your `Web` server
role :db,  "cachemakers.usu.edu", :primary => true # This is where Rails migrations will run

# role :db,  "your slave db-server here"

# if you want to clean up old releases on each deploy uncomment this:
# after "deploy:restart", "deploy:cleanup"

# if you're still using the script/reaper helper you will need
# these http://github.com/rails/irs_process_scripts

# If you are using Passenger mod_rails uncomment this:
# namespace :deploy do
#   task :start do ; end
#   task :stop do ; end
#   task :restart, :roles => :app, :except => { :no_release => true } do
#     run "#{try_sudo} touch #{File.join(current_path,'tmp','restart.txt')}"
#   end
# end

namespace "eventbrite" do
  task :symlink, :roles => :app do
    run "sudo ln -nfs /home/joel/wp-plugins/eventbrite-api/current /var/www/html/cachemakers.org/public/wp-content/plugins/eventbrite-api"
  end
  task :restart_webserver, :roles => :app do
    run "sudo service apache2 restart"
  end
end

after "deploy:symlink", "eventbrite:symlink"

namespace :deploy do
  task :restart, :except => { :no_release => true } do
    eventbrite.restart_webserver
  end
end