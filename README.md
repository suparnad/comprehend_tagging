# comprehend_tagging
This Drupall 11 custom module integrates with Amazon Comprehend to automatically tag Drupal content using taxonomy, based on custom classifier predictions.


---

## Requirements

- Drupal 11
- A vocabulary named `ai_tags`
- A taxonomy reference field `field_ai_tags` on the `article` content type
- A custom Comprehend classifier endpoint deployed in AWS

---

## Environment Variables

Use `.env` and `vlucas/phpdotenv` to load credentials:

AWS_ACCESS_KEY_ID=...
AWS_SECRET_ACCESS_KEY=...
AWS_DEFAULT_REGION=eu-west-2
AWS_COMPREHEND_ENDPOINT_ARN=arn:aws:comprehend:...

---

## Enable

```bash
drush en comprehend_tagging -y
```
Go to https://github.com/suparnad/aws_comprehend_for_auto_tag
Download terraform files
Follow steps to deploy(https://github.com/suparnad/aws_comprehend_for_auto_tag) 

Save or edit an article node to trigger automatic tagging.

Testing
Create or update an article with meaningful text in the body. The module will:

Extract the body text

Send it to the Comprehend endpoint

Add or reuse a term in ai_tags

Attach it to field_ai_tags

Logs are written to Drupal’s watchdog if Comprehend is unavailable.
