# SEAT BOOKING SYSTEM - TASK 2#

# ABOUT : I have created a api endpoint where you need to pass user selected seat no. and no. of tickets you want to buy, then system will return you the available ticket.

# STEPS TO SETUP PROJECT.

* TAKE PULL FROM GIT AND SETUP THE PROJECT
* SETUP DATABASE MENTIONED ON .ENV FILE
* RUN MIGRATION ( PHP ARTISAN MIGRATE )
* RUN SEEDING ( PHP ARTISAN DB::SEED )
* RUN BELOW ENDPOINT

# Api endpoint - http://localhost:8002/api/bookticket
# Request Body :
{
  "seat_no":"T5", // make sure Alphabet should be A-T and number should be 1-10
  "ticket_count":3
}

# Sample response

{
  "response": {
    "code": "200",
    "message": "Records fetched successfully.",
    "seats": [
      "T5",
      "S5",
      "R5"
    ]
  }
}

