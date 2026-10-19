<?php
namespace Drupal\schedule_entity;

use Drupal\Core\Datetime\DateFormatterInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Routing\RedirectDestinationInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ScheduleListBuilder extends EntityListBuilder {

  /**
   * Constructs a new NodeListBuilder object.
   *
   * @param \Drupal\Core\Entity\EntityTypeInterface $entity_type
   * The entity type definition.
   * @param \Drupal\Core\Entity\EntityStorageInterface $storage
   * The entity storage class.
   * @param \Drupal\Core\Datetime\DateFormatterInterface $dateFormatter
   * The date formatter service.
   */
  public function __construct(
    EntityTypeInterface $entity_type,
    EntityStorageInterface $storage,
    protected DateFormatterInterface $dateFormatter,
  ) {
    parent::__construct($entity_type, $storage);
  }

  /**
   * {@inheritdoc}
   */
  public static function createInstance(ContainerInterface $container, EntityTypeInterface $entity_type) {
    return new static(
      $entity_type,
      $container->get('entity_type.manager')->getStorage($entity_type->id()),
      $container->get('date.formatter'),
    );
  }



  public function buildHeader() {
    $header['id'] = $this->t('ID');
    $header['title'] = $this->t('Title');
    $header['changed'] = $this->t('Changed');
    return $header + parent::buildHeader();
  }

  public function buildRow(EntityInterface $entity) {
    $row['id'] = $entity->id();
    $row['title'] = $entity->toLink()->toString();
    $row['changed'] = $this->dateFormatter->format($entity->getChangedTime(), 'short');
    return $row + parent::buildRow($entity);
  }
}
