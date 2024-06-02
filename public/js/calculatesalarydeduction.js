document.addEventListener('input', calculateSalaryDeduction);

function calculateDaysBetween(startDate, endDate) {
    const start = new Date(startDate);
    const end = new Date(endDate);
    const timeDiff = end - start;
    return timeDiff / (1000 * 60 * 60 * 24) + 1; // Add 1 to include both start and end dates
}

function calculateSalaryDeduction() {
    const regularSalary = parseFloat(document.getElementById('regular_salary').value) || 0;

    const scheduleFrom = document.getElementById('regular_schedule_date_from').value;
    const scheduleTo = document.getElementById('regular_schedule_date_to').value;
    const leaveFrom = document.getElementById('leave_date_from').value;
    const leaveTo = document.getElementById('leave_date_to').value;
    const attendedFrom = document.getElementById('attended_date_from').value;
    const attendedTo = document.getElementById('attended_date_to').value;

    if (scheduleFrom && scheduleTo && leaveFrom && leaveTo && attendedFrom && attendedTo) {
        const totalScheduleDays = calculateDaysBetween(scheduleFrom, scheduleTo);
        const leaveDays = calculateDaysBetween(leaveFrom, leaveTo);
        const attendedDays = calculateDaysBetween(attendedFrom, attendedTo);

        const daysMissed = totalScheduleDays - leaveDays - attendedDays;

        const salaryDeductionPerDay = regularSalary / totalScheduleDays;
        const deductedSalary = daysMissed * salaryDeductionPerDay;
        const finalSalary = regularSalary - deductedSalary;

        document.getElementById('salary_deduction_per_day').value = salaryDeductionPerDay.toFixed(2);
        document.getElementById('deducted_salary').value = deductedSalary.toFixed(2);
        document.getElementById('final_salary').value = finalSalary.toFixed(2);
    }
}
