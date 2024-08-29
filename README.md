# TM Test Task

- [Easy Installation](#easy-installation)
- [Installation](#installation)
- [Tests](#tests)

## Easy Installation

Add necessary permissions:
```bash
    chmod +x install.sh
```

Add necessary permissions:
```bash
    chmod +x test.sh
```

Run bash script:
```bash
    ./install.sh
```

Run bash script:
```bash
    ./test.sh
```


## Installation

Copy environment variables:
```bash
    cp .env.example .env
```

Install dependencies:
```bash
    composer install
```

Build Docker container:
```bash
    docker compose build --no-cache
```

Run Docker container:
```bash
    docker compose up -d
```

Run migrations:
```bash
    docker compose exec php php bin/console doctrine:migrations:migrate --no-interaction
```

Run fixtures:
```bash
    docker compose exec php php bin/console doctrine:fixtures:load --append --no-interaction
```

## Tests

Build codeception configuration:
```bash
    vendor/bin/codecept build
```

Add necessary permissions:
```bash
    chmod +x dump.sh
```

Add necessary permissions:
```bash
    chmod +x create_test_db.sh
```

Run setup scripts:
```bash
    docker compose exec database ./dump.sh
```

Run setup scripts:
```bash
    docker compose exec database ./create_test_db.sh
```

Run tests:
```bash
    docker compose exec php vendor/bin/codecept run
```
