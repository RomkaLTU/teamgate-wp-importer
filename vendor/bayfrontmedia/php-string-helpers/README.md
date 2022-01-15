## PHP string helpers

PHP helper class to provide useful string functions.

- [License](#license)
- [Author](#author)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)

## License

This project is open source and available under the [MIT License](LICENSE).

## Author

John Robinson, [Bayfront Media](https://www.bayfrontmedia.com)

## Requirements

* PHP >= 7.1.0

## Installation

```
composer require bayfrontmedia/php-string-helpers
```

## Usage

- [has](#has)
- [hasSpace](#hasspace)
- [startsWith](#startswith)
- [endsWith](#endswith)
- [startWith](#startwith)
- [endWith](#endwith)
- [lowercase](#lowercase)
- [uppercase](#uppercase)
- [titleCase](#titlecase)
- [camelCase](#camelcase)
- [kebabCase](#kebabcase)
- [snakeCase](#snakecase)
- [random](#random)
- [uuid](#uuid)

<hr />

### has

**Description:**

Checks if string contains a case-sensitive needle.

**Parameters:**

- `$string` (string)
- `$needle` (string)

**Returns:**

- (bool)

**Example:**

```
use Bayfront\StringHelpers\Str;

$string = 'This is a string.';

if (Str::has($string, 'this')) {

    // Do something

}
```

<hr />

### hasSpace

**Description:**

Checks if string contains any whitespace.

**Parameters:**

- `$string` (string)

**Returns:**

- (bool)

**Example:**

```
use Bayfront\StringHelpers\Str;

$string = 'This is a string.';

if (Str::hasSpace($string)) {

    // Do something

}
```

<hr />

### startsWith

**Description:**

Checks if a string starts with a given case-sensitive string.

**Parameters:**

- `$string` (string)
- `$starts_with` (string)

**Returns:**

- (bool)

**Example:**

```
use Bayfront\StringHelpers\Str;

$string = 'This is a string.';

if (Str::startsWith($string, 'this')) {

    // Do something

}
```

<hr />

### endsWith

**Description:**

Checks if a string ends with a given case-sensitive string.

**Parameters:**

- `$string` (string)
- `$ends_with` (string)

**Returns:**

- (bool)

**Example:**

```
use Bayfront\StringHelpers\Str;

$string = 'This is a string.';

if (Str::endsWith($string, 'string.')) {

    // Do something

}
```

<hr />

### startWith

**Description:**

Returns string, ensuring that it starts with a given string.

**Parameters:**

- `$string` (string)
- `$start_with` (string)

**Returns:**

- (string)

**Example:**

```
use Bayfront\StringHelpers\Str;

$string = 'This is a string.';

echo Str::startWith($string, 'Hello! ');
```

<hr />

### endWith

**Description:**

Returns string, ensuring that it ends with a given string.

**Parameters:**

- `$string` (string)
- `$end_with` (string)

**Returns:**

- (string)

**Example:**

```
use Bayfront\StringHelpers\Str;

$string = 'This is a string.';

echo Str::endWith($string, ' Goodbye!');
```

<hr />

### lowercase

**Description:**

Converts string to lowercase using a specified character encoding.

See: [https://www.php.net/manual/en/mbstring.supported-encodings.php](https://www.php.net/manual/en/mbstring.supported-encodings.php)

**Parameters:**

- `$string` (string)
- `$encoding = 'UTF-8'` (string)

**Returns:**

- (string)

**Example:**

```
use Bayfront\StringHelpers\Str;

$string = 'This is a string.';

echo Str::lowercase($string);
```

<hr />

### uppercase

**Description:**

Converts string to uppercase using a specified character encoding.

See: [https://www.php.net/manual/en/mbstring.supported-encodings.php](https://www.php.net/manual/en/mbstring.supported-encodings.php)

**Parameters:**

- `$string` (string)
- `$encoding = 'UTF-8'` (string)

**Returns:**

- (string)

**Example:**

```
use Bayfront\StringHelpers\Str;

$string = 'This is a string.';

echo Str::uppercase($string);
```

<hr />

### titleCase

**Description:**

Converts string to title case using a specified character encoding.

See: [https://www.php.net/manual/en/mbstring.supported-encodings.php](https://www.php.net/manual/en/mbstring.supported-encodings.php)

**Parameters:**

- `$string` (string)
- `$encoding = 'UTF-8'` (string)

**Returns:**

- (string)

**Example:**

```
use Bayfront\StringHelpers\Str;

$string = 'This is a string.';

echo Str::titleCase($string);
```

<hr />

### camelCase

**Description:**

Converts string to camel case, removing any non-alpha and non-numeric characters.

**Parameters:**

- `$string` (string)

**Returns:**

- (string)

**Example:**

```
use Bayfront\StringHelpers\Str;

$string = 'This is a string.';

echo Str::camelCase($string);
```

<hr />

### kebabCase

**Description:**

Converts string to kebab case (URL-friendly slug), replacing any non-alpha and non-numeric characters with a hyphen.

**Parameters:**

- `$string` (string)
- `$lowercase = false` (bool): Convert string to lowercase

**Returns:**

- (string)

**Example:**

```
use Bayfront\StringHelpers\Str;

$string = 'This is a string.';

echo Str::kebabCase($string);
```

<hr />

### snakeCase

**Description:**

Converts string to snake case, replacing any non-alpha and non-numeric characters with an underscore.

**Parameters:**

- `$string` (string)
- `$lowercase = false` (bool): Convert string to lowercase

**Returns:**

- (string)

**Example:**

```
use Bayfront\StringHelpers\Str;

$string = 'This is a string.';

echo Str::snakeCase($string);
```

<hr />

### random

**Description:**

Return a random string of specified length and type.

Type of `all` includes alphanumeric and special characters.

**Note: Returned string is not cryptographically secure.**

**Parameters:**

- `$length = 8` (int)
- `$type = 'all'` (string): Valid types include: `nonzero`, `alpha`, `numeric`, `alphanumeric`, and `all`

**Returns:**

- (string)

**Example:**

```
use Bayfront\StringHelpers\Str;

echo Str::random(16, 'alphanumeric');
```

<hr />

### uuid

**Description:**

Return a UUID v4 string.

**Parameters:**

- (None)

**Returns:**

- (string)

**Example:**

```
use Bayfront\StringHelpers\Str;

echo Str::uuid();
```