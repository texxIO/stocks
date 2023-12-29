### How to 

Set the `ALPHA_VANTAGE_API_KEY` variable in the `.env` file

#### Run the commands in the terminal to start the project locally
1. `docker-compose up` 
2. `make setup` ( runs the migrations, seeders, npm )
3. `make artisan-queue-work` ( starts the queue worker )
4. `make artisan-schedule-work` ( starts the scheduler )
5. `make artisan-horizon` ( optional, starts the horizon dashboard )


## API Endpoints

`GET /api/forex` - returns all currencies
`GET /api/forex/{currency_pair}` - returns the currency_pair rates

## Notes
The application is using the Alpha Vantage API. 
The free version of the API has a limit of 5 requests per minute and `25 requests per day`.


## TODO
    [ ] Create some frontend with graphs to display the rates
    [ ] Add tests

