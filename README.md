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

AWS_ACCESS_KEY_ID = ...
AWS_SECRET_ACCESS_KEY = ...
AWS_DEFAULT_REGION = ....
AWS_COMPREHEND_ENDPOINT_ARN = arn:aws:comprehend:...

---

## Enable

```bash
drush en comprehend_tagging -y
```
Go to [AWS comprehend repo](https://github.com/suparnad/aws_comprehend_for_auto_tag)
Download terraform files

Follow steps to [deploy](https://github.com/suparnad/aws_comprehend_for_auto_tag) 

## Test 

1. Create a taxonomy, vocabulary name AI tags (machine name : ai_tags)

2. Add that taxonomy to the Article content type.

3. Create an article with meaningful text in the body. 

The module will:

  1. Extract the body text

  2. Send it to the Comprehend endpoint

  3. Add or reuse a term in ai_tags

  4. Attach it to field_ai_tags

4. Logs are written to Drupal’s watchdog if Comprehend is unavailable.
