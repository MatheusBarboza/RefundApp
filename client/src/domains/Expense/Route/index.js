import { crud, crudAuthorization } from 'src/utils/Router'
import { ROLE } from 'src/utils/Enum'

const list = () => import('src/view/Dashboard/Expense/List')
const form = () => import('src/view/Dashboard/Expense/Item')
const domain = 'expenses'

const authorization = crudAuthorization([ROLE.EMPLOYER], [ROLE.EMPLOYER], [ROLE.EMPLOYER])

export const routes = (router) => [
  ...crud(domain, list, form, authorization)
]
