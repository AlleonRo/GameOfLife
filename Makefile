.PHONY: dependencies tests
current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))

build: ## Build container
	@docker-compose build
	@make dependencies

dependencies: ## install dependencies
	docker-compose run --rm php composer install

help: ## Prints help.
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

tests: ## run tests
	docker-compose run --rm php composer run-script tests