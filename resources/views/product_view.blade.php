<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>اطلاعات بیشتر</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="mx-auto mt-5 max-w-md p-4 bg-white " id="products-container">

</div>
<script>
    let path = window.location.pathname;
    let parts = path.split('/');
    let product = parts[2];
    console.log(product)
    fetch(`https://jsonplaceholder.typicode.com/users/${product}`)
        .then(res => {
            return  res.json()
        })
        .then(data => {

                let content = `<div class="bg-white overflow-hidden shadow rounded-lg border">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            اطلاعات کاربر
        </h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">
            اینها یه مقدار اطلاعات بیشتر از این یوزر است
        </p>
    </div>
    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
        <dl class="sm:divide-y sm:divide-gray-200">
            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Full name
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    ${data.name}
                </dd>
            </div>
            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Email address
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    ${data.email}
                </dd>
            </div>
            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    username
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                     ${data.username}
                </dd>
            </div>
    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    phone
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                      ${data.phone}
                </dd>
            </div>
    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    website
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                     ${data.website}
                </dd>
            </div>

            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Address
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    ${data.address['street']}<br>
                     ${data.address['suite']}, ${data.address['city']} ${data.address['zipcode']}
                </dd>
            </div>
<div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    company
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    ${data.company['name']}<br>
                     ${data.company['catchPhrase']}, ${data.address['bs']}
                </dd>
            </div>
        </dl>
    </div>
</div>
            `

                document.getElementById('products-container').insertAdjacentHTML('beforeend' , content)
            })

</script>
</body>
</html>
