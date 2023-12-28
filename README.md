### How to 

Set the `ALPHA_VANTAGE_API_KEY` variable in the `.env` file

#### Run the commands in the terminal to start the project locally
1. `docker-compose up` 
2. `make setup`
3. `make artisan-schedule-work`


To start the scheduler or the jobs workers use one of the command:
- `make artisan-schedule-work`
- `make artisan-queue-work`


## API Endpoints

`GET /api/forex` - returns all currencies
`GET /api/forex/{currency}` - returns the currency with the given name

## Notes
The application is using the Alpha Vantage API. 
The free version of the API has a limit of 5 requests per minute and `25 requests per day`.