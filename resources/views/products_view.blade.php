<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
        <div class="mx-auto mt-5 max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 ">
            <div class="flex items-center justify-between mb-4">
                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">اخرین مشتریان</h5>
            </div>
            <div class="flow-root">
                <ul role="list" id="products-container" class="divide-y divide-gray-200 dark:divide-gray-700">

                </ul>
            </div>
        </div>
    <script>
        fetch('https://jsonplaceholder.typicode.com/users')
            .then(res => {
               return  res.json()
            })
            .then(data => {
                data.forEach(user => {
                    let content = `<li class="py-3 sm:py-4">
    <div class="flex items-center">
        <div class="flex-shrink-0">
            <img class="w-8 h-8 rounded-full" src="https://img.icons8.com/?size=100&id=7819&format=png&color=000000" alt="Neil image">
        </div>
        <div class="flex-1 min-w-0 ms-4">
            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                ${user.name}
            </p>
            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                ${user.email}
            </p>
        </div>
        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
            <a href="/products/${user.id}" class="bg-blue-600 text-white p-2">بیشتر</a>
        </div>
    </div>
</li>
            `

                    document.getElementById('products-container').insertAdjacentHTML('beforeend' , content)
                })
            })
    </script>
</body>
</html>
