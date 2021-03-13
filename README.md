# Blockchain project writing on PHP

Today I have implemented minimal working blockchain and it will be possible I will be improving this project for the purpose of learning new things in this area.
 
 The [laravel\lumen](https://lumen.laravel.com) framework was used as the basic.  
 
 **Require environment:**
 * *php >= 7.4*
 * *composer*
 
 **Instruction for running:**
 1. Clone this project
 2. Run *composer install*
 3. Run *php artisan generate:blockchain_with_genesis_block*
 4. Run *php -S localhost:8000 -t public*
 
 *Endpoints:*
 * **GET /blockchain/show** - returns a chain of blocks in json format 
 * **POST /blockchain/create** - inserts a new block into the current blockchain with your data
 
 
 
