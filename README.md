### How to 

Set the `ALPHA_VANTAGE_API_KEY` variable in the `.env` file

#### Run the commands in the terminal to start the project locally
3. `docker-compose up`
3. `make composer-install`
4. `make artisan-migrate`
5. `make artisan-session-table`
6. `make artisan-queues-table`
7. `make artisan-seed-currencies`

To start the scheduler or the jobs workers use one of the command:
- `make artisan-schedule-work`
- `make artisan-queue-work`

