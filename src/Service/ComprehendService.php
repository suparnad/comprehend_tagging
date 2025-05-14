<?php

namespace Drupal\comprehend_tagging\Service;

use Aws\Comprehend\ComprehendClient;

/**
 * Service to interact with Amazon Comprehend.
 */
class ComprehendService
{

  /**
   * The AWS Comprehend client.
   *
   * @var \Aws\Comprehend\ComprehendClient
   */
  protected $client;

  /**
   * Constructs the ComprehendService.
   */
  public function __construct()
  {
    $this->client = new ComprehendClient([
      'version' => 'latest',
      'region' => 'eu-west-2', // Use the AWS region you prefer
      'credentials' => [
        'key' => getenv('YOUR_AWS_KEY'),
        'secret' => getenv('YOUR_AWS_SECRET'),
      ],
    ]);
  }

  /**
   * Extracts named entities from given text.
   *
   * @param string $text
   *   The body content to analyze.
   *
   * @return array
   *   List of detected entities.
   */
  public function extractEntities(string $text): array
  {
    try {
      $result = $this->client->classifyDocument([
        'EndpointArn' => getenv('AWS_COMPREHEND_ENDPOINT_ARN'),
        'Text' => $text,
      ]);

      return $result['Classes'] ?? [];
    } catch (\Exception $e) {
      \Drupal::logger('comprehend_tagging')->error('Comprehend error: @message', [
        '@message' => $e->getMessage(),
      ]);
      return [];
    }
  }
}
