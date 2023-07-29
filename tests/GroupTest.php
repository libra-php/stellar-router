<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use StellarRouter\Group;

final class GroupTest extends TestCase
{
  public function test_group_prefix_must_be_valid_path(): void
  {
    $this->expectException(\Exception::class);
    $this->expectExceptionMessage("Path must start with a /");
    $group = new Group('invalid', []);
  }
}

