# Testing

- Download the repository
- Create a `.env` file from the `.env.example` and switch the variable `DELIVERY_DEBUG` to `true` for testing
- Run `composer install`
- Run `php artisan serve` (For this test task I didn't add the database tables, so no migrations need to be executed)
- Run the request to the endpoint `http://127.0.0.1:8000/api/send-parcel`

Example request body
```json
{
    "email": "loshad@yopmail.com",
    "name": "John Doe",
    "phone": "+380631234567",
    "address": "New Heaven ave. 123",
    "operator": "novaposhta"
}
```
- Switch `DELIVERY_DEBUG` back to `false` to disable `FakeDeliveryService`

If a client will have A LOT of operators we'll need to update DeliveryServiceEnum and add
required services and response converters. Also, factories should be updated to handle the additional operators.
  
For testing purpose FakeDeliveryService was created. To disable it just change flag `DELIVERY_DEBUG` in the `.env` file.
  
Question: If the customer has a problem with the delivery of orders. Customer sends data, but courier service support says they are not receiving data from current service.
In this case we should rely on the response from the delivery service. If we're receiving response as expected - we're good,
but it should be discussed with the delivery operator.
BUT if the response is empty or wrong (and we're sure it's issue on the operator side) we can postpone
request sending with a delayed job.

Please, check the `DeliveryController` for additional info.
