.PHONY: build install generate build-site serve test lint fix-lint coverage help

IMAGE_NAME = mergephp-website
CONTAINER_NAME = mergephp-website-container
HOST_PORT = 8000
CONTAINER_PORT = 8000

# Default target
help:
	@echo "Available commands:"
	@echo "  make build       - Build the Docker image"
	@echo "  make install     - Install Composer dependencies"
	@echo "  make generate    - Generate a new meetup"
	@echo "  make build-site  - Build the static site"
	@echo "  make serve       - Serve the site on localhost:$(HOST_PORT)"
	@echo "  make test        - Run PHPUnit tests"
	@echo "  make lint        - Check code style"
	@echo "  make fix-lint    - Fix lint errors automatically"
	@echo "  make coverage    - Generate code coverage report"
	@echo "  make bash        - Open a bash shell in the container"

# Build the Docker image
build:
	docker build -t $(IMAGE_NAME) .

# Install dependencies
install:
	docker run --rm -v $(PWD):/var/www/html $(IMAGE_NAME) composer install

# Generate a new meetup
generate: build
	docker run --rm -it -v $(PWD):/var/www/html $(IMAGE_NAME) composer generate

# Build the static site
build-site: build
	docker run --rm -v $(PWD):/var/www/html $(IMAGE_NAME) composer build

# Serve the site
serve: build
	docker run --rm -p $(HOST_PORT):$(CONTAINER_PORT) -v $(PWD):/var/www/html --name $(CONTAINER_NAME) $(IMAGE_NAME) php -S 0.0.0.0:$(CONTAINER_PORT) -t docs/

# Run tests
test: build
	docker run --rm -v $(PWD):/var/www/html $(IMAGE_NAME) composer test

# Run lint check
lint: build
	docker run --rm -v $(PWD):/var/www/html $(IMAGE_NAME) composer lint

# Fix lint errors
fix-lint: build
	docker run --rm -v $(PWD):/var/www/html $(IMAGE_NAME) composer fix-lint-errors

# Generate code coverage
coverage: build
	docker run --rm -v $(PWD):/var/www/html $(IMAGE_NAME) composer coverage

# Open a bash shell in the container
bash: build
	docker run --rm -it -v $(PWD):/var/www/html $(IMAGE_NAME) bash
