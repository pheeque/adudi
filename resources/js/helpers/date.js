export const dayWithZero = day => {
    return day < 10 ? `0${day}` : day
}

export const taskFullDueDate = day => {
    return `${new Date().getFullYear()}-${dayWithZero(new Date().getMonth() + 1)}-${dayWithZero(day)}`
}