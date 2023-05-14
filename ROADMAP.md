## Project Roadmap
Given more time, here are the ideas for refactoring and improvements

### P0
- Refactor the verify method in the VerificationController for better code organization and readability.
  - Use Form Request Validation to validate logic inside `VerificationController` rather than validate it manually inside controller's class
- Implement proper error handling
  - Create an exception handler that handle all kinds of error. e.g. when we hit dns.google API and it's taking too long, we are gonna return gateway timeout (504)
- Add authentication feature

### P1
- Refactor to use service or repository pattern to encapsulate the database operations.
- Implement logging and monitoring to track and analyze API usage, errors, and performance.
- Consider implementing caching mechanisms to improve performance for repetitive or expensive operations.
- Implement API versioning to handle future changes and maintain backward compatibility.
