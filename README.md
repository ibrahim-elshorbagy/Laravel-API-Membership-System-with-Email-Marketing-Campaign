# Laravel API For Email Marketing campaign

## Login Routes

| Type  | URL                                  | Accepts                                             |
|-------|--------------------------------------|-----------------------------------------------------|
| POST  | `/api/register`                      | `first_name`,`last_name`,`username`, `email`, `password`, `password_confirmation`|
| POST  | `/api/login`                         | `email or username`, `password`                                 |
| POST  | `/api/logout`                        | `Add the Token`                                     |
| POST  | `/api/forgot-password`               | `email`                                             |

 




# Profile

| Method     | URL                                    | Description                                            | Accepts                                             |
|------------|----------------------------------------|--------------------------------------------------------|-----------------------------------------------------|
| POST       | `/api/profile/update-password`| Update User Password                                   |`old_password`, `password`, `password_confirmation`|

       


## Freamworks Used
- Laravel 11
