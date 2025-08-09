# Enzona Payment Gateway for WooCommerce

[![CI](https://github.com/freddysae0/enzona-payments/actions/workflows/ci.yml/badge.svg)](https://github.com/freddysae0/enzona-payments/actions/workflows/ci.yml)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D5.5-blue.svg)](https://php.net)

A comprehensive WordPress plugin that integrates **Enzona**, Cuba's leading payment platform, with **WooCommerce** e-commerce stores. This plugin provides a seamless payment experience for Cuban customers using the official Enzona Payment API.

## 📋 Table of Contents

- [Features](#-features)
- [Requirements](#-requirements)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Usage](#-usage)
- [API Reference](#-api-reference)
- [Project Structure](#-project-structure)
- [Development](#-development)
- [Testing](#-testing)
- [Contributing](#-contributing)
- [License](#-license)
- [Support](#-support)

## ✨ Features

- **Full WooCommerce Integration**: Seamlessly integrates with WooCommerce checkout process
- **Enzona API Client**: Complete PHP SDK for Enzona Payment API v1.0.0
- **Secure Payment Processing**: OAuth2 authentication with access tokens
- **Real-time Transaction Status**: Automatic order status updates based on payment status
- **Multi-currency Support**: Primarily supports Cuban Peso (CUP)
- **Refund Management**: Built-in support for payment refunds through Enzona
- **Debug Mode**: Comprehensive logging and debugging capabilities
- **Responsive Design**: Mobile-friendly payment interface
- **Error Handling**: Robust error handling and user feedback

## 📋 Requirements

### System Requirements
- **PHP**: >= 5.5
- **WordPress**: >= 4.9
- **WooCommerce**: >= 7.0.0
- **SSL Certificate**: Required for production environment

### PHP Extensions
- `ext-curl`: For HTTP requests to Enzona API
- `ext-json`: For JSON data processing
- `ext-mbstring`: For string handling

### Dependencies
- **GuzzleHttp**: ^6.2 (HTTP client library)
- **Swagger Codegen**: Generated API client

## 🚀 Installation

### Method 1: Manual Installation

1. **Download the plugin**:
   ```bash
   git clone https://github.com/freddysae0/enzona-payments.git
   cd enzona-payments
   ```

2. **Install dependencies**:
   ```bash
   composer install --no-dev
   ```

3. **Upload to WordPress**:
   - Compress the plugin folder
   - Upload via WordPress Admin → Plugins → Add New → Upload Plugin
   - Or copy the folder to `/wp-content/plugins/`

4. **Activate the plugin**:
   - Go to WordPress Admin → Plugins
   - Find "Enzona para WooCommerce" and click "Activate"

### Method 2: WordPress Repository (Future)
```
WordPress Admin → Plugins → Add New → Search "Enzona WooCommerce"
```

## ⚙️ Configuration

### 1. Enzona Account Setup

Before configuring the plugin, you need:
1. **Enzona Business Account**: Register at [enzona.net](https://enzona.net)
2. **Merchant Approval**: Wait for business account approval
3. **API Credentials**: Obtain from your Enzona merchant dashboard

### 2. Plugin Configuration

#### Access Plugin Settings
Navigate to: `WooCommerce → Settings → Payments → Enzona`

#### Required Configuration Fields

| Field | Description | Required |
|-------|-------------|----------|
| **Enable/Disable** | Enable Enzona payment method | Yes |
| **Title** | Payment method title shown to customers | Yes |
| **Description** | Payment method description | Yes |
| **Access Token** | OAuth2 access token from Enzona | Yes |
| **Merchant UUID** | Your unique merchant identifier | Yes |

#### Configuration Steps

1. **Enable the Gateway**:
   - Check "Enable Enzona" checkbox
   - Set title: `Enzona` (or your preferred name)
   - Set description: `Paga con Enzona, plataforma de pagos en Cuba`

2. **Enter API Credentials**:
   ```
   Access Token: [Your Enzona Access Token]
   Merchant UUID: [Your Merchant UUID]
   ```

3. **Save Configuration**:
   - Click "Save changes"
   - Test the configuration in sandbox mode first

### 3. WordPress Configuration Page

The plugin includes a dedicated configuration page:

**Access**: `WordPress Admin → Enzona Payments`

This page provides:
- Easy credential input interface
- Configuration validation
- Visual setup guide with screenshots
- Direct links to Enzona merchant portal

## 💳 Usage

### Customer Payment Flow

1. **Checkout Process**:
   - Customer adds products to cart
   - Proceeds to checkout
   - Selects "Enzona" as payment method
   - Clicks "Place order"

2. **Enzona Payment**:
   - Customer is redirected to Enzona payment page
   - Completes payment using Enzona app or web interface
   - Returns to store with payment confirmation

3. **Order Completion**:
   - Order status automatically updates to "Completed" (success) or "Failed"
   - Customer receives confirmation email
   - Store admin gets notification

### Payment Status Codes

| Code | Status | Description |
|------|--------|-------------|
| 1116 | Completed | Payment successful |
| 1112 | Failed | Payment failed or cancelled |
| Pending | Processing | Payment in progress |

### Supported Operations

#### Payment Creation
```php
// Create new payment
$payload = new Payload();
$payload->setAmount($amount);
$payload->setCurrency('CUP');
$payload->setDescription('Payment description');
$payload->setMerchant_uuid($merchant_uuid);

$result = $api->paymentsPost($payload);
```

#### Payment Status Check
```php
// Check payment status
$result = $api->paymentsTransactionUuidGet($transaction_uuid);
$status = $result['status_code'];
```

#### Payment Refund
```php
// Process refund
$refund_data = new PaymentstransactionUuidrefundAmount();
$refund_data->setAmount($refund_amount);

$result = $api->paymentsTransactionUuidRefundsPost($transaction_uuid, $refund_data);
```

## 📚 API Reference

### Core Classes

#### Payment Gateway
- **Class**: `Enzona_Payment`
- **Extends**: `WC_Payment_Gateway`
- **Purpose**: Main WooCommerce payment gateway implementation

#### API Clients

| Class | Purpose |
|-------|---------|
| `PermiteCrearUnPagoApi` | Create payments |
| `ObtieneLosDetallesDeUnPagoRealizadoApi` | Get payment details |
| `PermiteRealizarLaDevolucinDeUnPagoApi` | Process refunds |
| `ObtieneListadoDePagosRealizadosApi` | List payments |
| `PermiteCancelarUnPagoApi` | Cancel payments |
| `PermiteCompletarUnPagoApi` | Complete payments |
| `PermiteConfirmarUnPagoApi` | Confirm payments |

#### Data Models

| Model | Purpose |
|-------|---------|
| `Payload` | Payment request data |
| `PaymentsAmount` | Payment amount details |
| `PaymentsItems` | Payment line items |
| `PaymentFullInfo` | Complete payment information |
| `PaymentSummaryInfo` | Payment summary |

### API Endpoints

Base URL: `https://api.enzona.net/payment/v1.0.0`

| Method | Endpoint | Purpose |
|--------|----------|---------|
| POST | `/payments` | Create payment |
| GET | `/payments/{uuid}` | Get payment details |
| GET | `/payments` | List payments |
| POST | `/payments/{uuid}/refunds` | Create refund |
| GET | `/payments/{uuid}/refunds` | List refunds |
| PUT | `/payments/{uuid}/complete` | Complete payment |
| PUT | `/payments/{uuid}/cancel` | Cancel payment |

### Configuration Class

```php
use daxslab\enzona\payment\Configuration;

$config = Configuration::getDefaultConfiguration()
    ->setAccessToken('YOUR_ACCESS_TOKEN')
    ->setHost('https://api.enzona.net/payment/v1.0.0');
```

## 📁 Project Structure

```
enzona-payments/
├── 📄 enzona-payment.php          # Main plugin file
├── 📄 paymentMethod.php           # WooCommerce payment gateway
├── 📄 configPage.php              # Admin configuration page
├── 📄 composer.json               # Dependency management
├── 📄 phpunit.xml                 # PHPUnit configuration
├── 📄 .travis.yml                 # CI/CD configuration
├── 📄 .php_cs                     # PHP CS Fixer rules
│
├── 📁 lib/                        # Core library
│   ├── 📄 Configuration.php       # API configuration
│   ├── 📄 ApiException.php        # Exception handling
│   ├── 📄 ObjectSerializer.php    # Data serialization
│   ├── 📄 HeaderSelector.php      # HTTP headers
│   │
│   ├── 📁 api/                    # API client classes
│   │   ├── 📄 PermiteCrearUnPagoApi.php
│   │   ├── 📄 ObtieneLosDetallesDeUnPagoRealizadoApi.php
│   │   └── 📄 [Other API classes...]
│   │
│   └── 📁 model/                  # Data model classes
│       ├── 📄 Payload.php
│       ├── 📄 PaymentsAmount.php
│       ├── 📄 PaymentsItems.php
│       └── 📄 [Other model classes...]
│
├── 📁 docs/                       # API documentation
│   ├── 📁 Api/                    # API endpoint docs
│   └── 📁 Model/                  # Data model docs
│
├── 📁 test/                       # Unit tests
│   ├── 📁 Api/                    # API tests
│   └── 📁 Model/                  # Model tests
│
├── 📁 assets/                     # Plugin assets
│   └── 📄 icon.jpg               # Enzona icon
│
├── 📁 cert/                       # SSL certificates
│   └── 📄 cert.pem               # Certificate file
│
└── 📁 vendor/                     # Composer dependencies
    └── [Dependency packages...]
```

### Key Files Explained

#### Core Plugin Files
- **`enzona-payment.php`**: Main plugin entry point, handles WordPress integration
- **`paymentMethod.php`**: WooCommerce payment gateway implementation
- **`configPage.php`**: WordPress admin configuration interface

#### Library Files
- **`lib/`**: Auto-generated Swagger/OpenAPI client library
- **`lib/api/`**: API endpoint client classes
- **`lib/model/`**: Data structure model classes
- **`lib/Configuration.php`**: API client configuration

#### Documentation
- **`docs/`**: Comprehensive API documentation
- **`README.md`**: This documentation file

#### Testing & Quality
- **`test/`**: PHPUnit test cases
- **`phpunit.xml`**: Test configuration
- **`.php_cs`**: Code style rules
- **`.travis.yml`**: Continuous integration

## 🔧 Development

### Setting Up Development Environment

1. **Clone Repository**:
   ```bash
   git clone https://github.com/freddysae0/enzona-payments.git
   cd enzona-payments
   ```

2. **Install Dependencies**:
   ```bash
   composer install
   ```

3. **Set Up Local WordPress**:
   ```bash
   # Using Local by Flywheel, XAMPP, or similar
   # Copy plugin to wp-content/plugins/
   ```

4. **Configure Development Environment**:
   ```php
   // Set debug mode in enzona-payment.php
   $debug = true;
   ```

### Code Style

The project follows PSR-12 coding standards:

```bash
# Check code style
vendor/bin/php-cs-fixer fix --dry-run --diff

# Fix code style
vendor/bin/php-cs-fixer fix
```

### API Client Generation

The API client is generated using Swagger Codegen:

```bash
# Regenerate API client (if needed)
swagger-codegen generate \
  -i enzona-api-spec.yaml \
  -l php \
  -o ./lib \
  --invoker-package "daxslab\\enzona\\payment"
```

### Development Workflow

1. **Create Feature Branch**:
   ```bash
   git checkout -b feature/new-feature
   ```

2. **Make Changes**:
   - Follow coding standards
   - Add appropriate tests
   - Update documentation

3. **Test Changes**:
   ```bash
   composer test
   vendor/bin/php-cs-fixer fix
   ```

4. **Submit Pull Request**:
   - Ensure all tests pass
   - Provide clear description
   - Reference related issues

## 🧪 Testing

### Running Tests

```bash
# Run all tests
composer test

# Run specific test suite
vendor/bin/phpunit test/Api/
vendor/bin/phpunit test/Model/

# Run with coverage
vendor/bin/phpunit --coverage-html coverage/
```

### Test Structure

```
test/
├── Api/                           # API endpoint tests
│   ├── PermiteCrearUnPagoApiTest.php
│   └── [Other API tests...]
└── Model/                         # Data model tests
    ├── PayloadTest.php
    └── [Other model tests...]
```

### Testing Configuration

- **Framework**: PHPUnit 4.8+
- **Configuration**: `phpunit.xml`
- **Coverage**: Covers `lib/api/` and `lib/model/` directories

### Continuous Integration

GitHub Actions automatically runs the test suite on:
- PHP 8.2, 8.1, 8.0


## 🤝 Contributing

We welcome contributions from the community! Here's how you can help:

### Ways to Contribute

1. **Bug Reports**: Submit detailed bug reports with reproduction steps
2. **Feature Requests**: Suggest new features or improvements
3. **Code Contributions**: Submit pull requests for bug fixes or features
4. **Documentation**: Help improve documentation and examples
5. **Testing**: Test the plugin in different environments

### Contribution Guidelines

1. **Fork the Repository**: Create your own fork on GitHub
2. **Create Feature Branch**: Use descriptive branch names
3. **Follow Code Standards**: Adhere to PSR-12 coding standards
4. **Write Tests**: Include tests for new functionality
5. **Update Documentation**: Update relevant documentation
6. **Submit Pull Request**: Provide clear description of changes

### Development Setup

```bash
# Fork and clone
git clone https://github.com/freddysae0/enzona-payments.git
cd enzona-payments

# Install dependencies
composer install

# Create feature branch
git checkout -b feature/your-feature-name

# Make changes and test
composer test
vendor/bin/php-cs-fixer fix

# Commit and push
git add .
git commit -m "Add: your feature description"
git push origin feature/your-feature-name
```

### Code Review Process

1. All contributions require code review
2. Maintain backward compatibility
3. Follow semantic versioning
4. Ensure all tests pass
5. Update documentation as needed

## 📄 License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

```
MIT License

Copyright (c) 2025 Freddy Saez, Enzona Payment Gateway for WooCommerce

This code is built over Daxslab's Enzona Payment PHP SDK
https://github.com/daxslab/enzona-payment-php.git

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

## 📞 Support

### Getting Help

- **Documentation**: Check this README and `/docs` folder
- **Issues**: Submit GitHub issues for bugs or feature requests
- **Community**: Join discussions in GitHub Discussions
- **Email**: Contact the development team

### Reporting Issues

When reporting issues, please include:

1. **Environment Details**:
   - WordPress version
   - WooCommerce version
   - PHP version
   - Plugin version

2. **Issue Description**:
   - Clear description of the problem
   - Steps to reproduce
   - Expected vs actual behavior
   - Error messages (if any)

3. **Additional Context**:
   - Screenshots (if applicable)
   - Log files
   - Configuration details

### Frequently Asked Questions

**Q: Does this work on localhost?**
A: No, the plugin is designed for production environments with valid SSL certificates. Localhost development requires special configuration.

**Q: Which currencies are supported?**
A: Currently, the plugin primarily supports Cuban Peso (CUP) as required by Enzona.

**Q: Is this compatible with the latest WooCommerce?**
A: The plugin is tested with WooCommerce 7.0+ and regularly updated for compatibility.

**Q: How do I get Enzona API credentials?**
A: Register for a business account at [enzona.net](https://enzona.net) and apply for merchant approval.

**Q: Can I customize the payment flow?**
A: Yes, the plugin provides hooks and filters for customization. Check the source code for available hooks.

---

## 🏆 Acknowledgments

- **Enzona**: For providing the payment platform and API
- **Daxslab**: Original development team
- **WooCommerce**: E-commerce platform integration
- **Swagger/OpenAPI**: API client generation
- **Community Contributors**: All contributors who help improve the project

---

## 📈 Project Status

- **Status**: Active Development
- **Version**: 1.0.0
- **Last Updated**: 2025
- **Compatibility**: WordPress 4.9+, WooCommerce 7.0+, PHP 5.5+

### Roadmap

- [ ] WordPress Plugin Repository submission
- [ ] Enhanced error handling and user feedback
- [ ] Multi-language support (Spanish, English)
- [ ] Advanced reporting and analytics
- [ ] Webhook support for real-time notifications
- [ ] Subscription and recurring payments support

---

**Made with ❤️ in Cuba for the Cuban e-commerce community**
