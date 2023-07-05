To run this project please follow the instructions below:

1. Clone the repository by running the following command in an empty folder on your local machine:
```
git clone https://github.com/vortexhacker/code-challenge-mytheresa.com.git
```

2. Navigate to the root folder of the cloned repository. For example:
```
cd Documents/testapi/code-challenge-mytheresa.com
```

3. Make sure you are in the root folder of the repository. You should see a similar structure as shown in the image below.

   ![image](https://github.com/vortexhacker/code-challenge-mytheresa.com/assets/64105391/5d224804-8eb6-49e6-b52d-4e2a91555e7b)


5. To run the API, use the following command:
```
php artisan serve
```
You should see the following output:

![image](https://github.com/vortexhacker/code-challenge-mytheresa.com/assets/64105391/69f16825-545f-4b95-a76f-d81d8ca99a67)


5. Open your web browser and access the following endpoint:
```
http://localhost:8000/api/products
```
You should see the following output:

![image](https://github.com/vortexhacker/code-challenge-mytheresa.com/assets/64105391/2d504a62-ae07-4c5b-8b28-ac80be0e78f9)


6. If you want to run the test cases, use the following command (make sure to close any previously running command by pressing Ctrl and C):
```
php artisan test
```
You should see the following output:
![image](https://github.com/vortexhacker/code-challenge-mytheresa.com/assets/64105391/3326b584-bcae-4644-9b91-ff3b906e0c1d)
