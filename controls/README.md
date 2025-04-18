# Nested Select2 Control for Elementor

## Overview

This custom **Nested Select2** control for Elementor enables hierarchical category selection within a Select2 dropdown. It supports both **flat structured data** (with `level` tracking) and **nested structured data** (with `children` objects).

## Features

- Supports hierarchical category selection.
- Works with both **flat** and **nested** category structures.
- Uses **Elementor's Select2** for an improved UI experience.
- Supports **custom icons** for each category.
- Dynamically retrieves **WooCommerce product categories**.

---

## Installation

1. Copy the `Nested_Select2_Control` class into your Elementor plugin directory.
2. Register the control using Elementor's API:
   ```php
   \Elementor\Plugin::$instance->controls_manager->register_control(
       'nested_select2',
       new \Nested_Select2_Control()
   );
   ```
3. Ensure Select2 is properly loaded in Elementor.

Usage

## Usage/Examples

```php
$this->add_control(
    'nested_categories',
    [
        'label'   => __('Select Categories', 'plugin-domain'),
        'type'    => 'nested_select2',
        'options' => [],
        'nested_data' => \YourPluginNamespace::get_hierarchical_categories(),
        'placeholder' => __('Choose categories...', 'plugin-domain'),
    ]
);
```

### You can provide data in two hierarchical structure:

**Flat structured data** (with `level` tracking):

```json
[
  {
    "id": 1,
    "name": "Parent1",
    "icon": "http://placehold.it/32x32_0.png",
    "level": 0
  },
  {
    "id": 2,
    "name": "Child 1",
    "icon": "http://placehold.it/32x32_1.png",
    "level": 1
  },
  {
    "id": 3,
    "name": "Child 2",
    "icon": "http://placehold.it/32x32_2.png",
    "level": 1
  }
]
```

**Nested structured data** (with `children` objects):

```json
[
  {
    "id": 1,
    "name": "Parent1",
    "icon": "http://placehold.it/32x32_0.png",
    "children": [
      {
        "id": 2,
        "name": "Child 1",
        "icon": "http://placehold.it/32x32_1.png",
        "children": []
      },
      {
        "id": 3,
        "name": "Child 2",
        "icon": "http://placehold.it/32x32_2.png",
        "children": []
      }
    ]
  }
]
```

## Authors

- [@NesarAhmedRazon](https://github.com/NesarAhmedRazon)
