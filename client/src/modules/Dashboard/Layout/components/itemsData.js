import { ROLE } from 'src/utils/Enum'

function menuItem (title, icon = '', authorize, route) {
  return { title, icon, authorize, route }
}

export default [
  menuItem('Refunds Pending', 'account_balance_wallet', [ROLE.MANAGER], 'refunds'),
  menuItem('History Refunds', 'list', [ROLE.MANAGER], 'refundshistory'),
  menuItem('New Refund', 'add', [ROLE.EMPLOYER], 'refundsadd'),
  menuItem('Expenses', 'receipt_long', [ROLE.EMPLOYER], 'expenses')
]
