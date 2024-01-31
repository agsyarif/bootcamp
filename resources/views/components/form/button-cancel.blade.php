@props(['route'])

<a href="{{ route($route) }}" type="button"
class="inline-flex justify-center px-4 py-2 mr-4 text-sm font-medium text-gray-700 bg-white border border-gray-600 rounded-lg shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300"
onclick="return confirm('Are you sure want to cancel? , Any changes you make will not be saved !')">
    Cancel
</a>
