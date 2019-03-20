set :application, ENV['APP_NAME']
set :repo_url, ENV['DEPLOY_REPO']

# ask :branch, proc { `git rev-parse --abbrev-ref HEAD`.chomp }

set :deploy_to, ENV['DEPLOY_TO']

# set :scm, :git

# set :format, :pretty
# set :log_level, :debug
# set :pty, true

set :linked_files, %w{.env}
set :linked_dirs, %w{vendor}

# set :default_env, { path: "/opt/ruby/bin:$PATH" }
set :keep_releases, 2

namespace :deploy do
  invoke 'laravel:migrate'
  after :finishing, 'deploy:cleanup'
end
