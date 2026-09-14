# Changelog

## v5.0.0

- Support Filament v5 and Laravel 12 / 13 (PHP 8.2+).
- Location settings page uses the Filament v5 `form(Schema $schema)` API and header actions.
- `Location` model: fillable and `model()` relation now use the `model_type` / `model_id` columns created by the migration (`modal()` kept as a deprecated alias).
- Test suite covering every resource page, create / edit round-trips, the settings page and the artisan commands.
