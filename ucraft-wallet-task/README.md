
## About Project
### Create Wallet used Laravel framework
#### The requirements
1. User should register and log in to the system: you need to implement user registration
   and login flow. +
2. There should be 2 ways of registration: via email &amp; via google or Facebook. +
3. To be able to log in the user has to verify his/her account from the email he/she gets. +
4. When logged in for the first time user should be able to add his wallet in order to
   continue (think of it of UX perspective) +
5. Wallets should have name and type (examples: credit card, cash), note that user can
   add as many wallets as wanted. +
6. After adding wallets user should be able to add records.
7. Records can be of Credit or Debit types. User should choose the wallet of which to
   remove or to add a specific amount.
8. Don&#39;t forget to show the total balance, and the balance of each wallet and update it in a
   separate Reporting section.
9. Write appropriate unit tests.

The lines with the '+' sign done in the project, for others was done some work but not finished.
In project used few classes from https://github.com/bavix/laravel-wallet repo. But mostly I adapted it with the project.
Also here is my github repo --> https://github.com/Harutin1991/ucraftUnit with few unit test examples, which 
I did in my last project.
In `.env.example` I have added mail configs.

### To get the project up and running:
1. Run `cp .env.example .env`
2. Run `sail up` to start the containers. `sail up -d` will start the containers in the background and is generally more convenient.
3. Run `sail composer install` to install PHP dependencies.
4. Run `sail artisan migrate` to prepare the database.
5. Run `sail npm i` to install node dependencies.
6. Run `sail npm run dev` to start asset compilation and HMR.
7. Website will be available at `http://localhost:38000` and will have HMR / auto-reload, if `npm run dev` is running. Otherwise, there will be no auto-reload.
8. Press `ctrl+c` or run `sail stop` to stop the containers.

### Day-to-day usage

`sail up -d` and `sail npm run dev` is usually enough to start working when the project has been set up already.


## Integrations

#### Livewire
#### Filement ( partial )
#### Mail
#### Google Login
#### Facebook Login


## Random notes

Used Github Repo: https://github.com/bavix/laravel-wallet

https://filamentphp.com/plugins/spatie-activity-log

https://github.com/ryangjchandler/filament-tools

https://filamentphp.com/plugins/spatie-health

https://laravel-livewire.com/

### Onboarding

Email verified: yes / no
