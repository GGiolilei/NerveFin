ErrorException
resources\views\dashboard\index.blade.php:46
Attempt to read property "name" on null

LARAVEL
13.30.1
PHP
8.4.8
UNHANDLED
CODE 0
500
GET
http://127.0.0.1:8000/dashboard

Exception trace
Illuminate\Foundation\Bootstrap\HandleExceptions->{closure:Illuminate\Foundation\Bootstrap\HandleExceptions::forwardsTo():262}()
resources\views\dashboard\index.blade.php:46

41                            <tr>
42                                <td class="py-3">{{ $expense->spent_at->format('d M Y') }}</td>
43                                <td class="py-3 font-medium text-gray-900">{{ $expense->name }}</td>
44                                <td class="py-3">{{ $expense->category->name }}</td>
45                                <td class="py-3">{{ $expense->user->name }}</td>
46                                <td class="py-3">{{ $expense->financialAccount->name }}</td>
47                                <td class="py-3 text-right font-bold text-red-600">-{{ $expense->formatted_amount }}</td>
48                            </tr>
49                        @empty
50                            <tr>
51                                <td colspan="6" class="py-4 text-center text-gray-500">No expenses recorded yet.</td>
52                            </tr>
53                        @endforelse
54                    </tbody>
55                </table>
56            </div>