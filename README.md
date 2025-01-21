# Laravel API For Membership System with Email Marketing campaign

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
| POST       | `/api/profile/update-profile-image`| Update User image                                   |`image`|
| POST       | `/api/profile/update-name`| Update User name                                   |`first_name`, `last_name`|

       


## Freamworks Used
- Laravel 11
