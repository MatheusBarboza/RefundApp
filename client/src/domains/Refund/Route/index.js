import { crud, route, crudAuthorization } from 'src/utils/Router'
import { ROLE, SCOPES } from 'src/utils/Enum'

const list = () => import('src/view/Dashboard/Refund/List')
const form = () => import('src/view/Dashboard/Refund/Item')
const history = () => import('src/view/Dashboard/Refund/History')
const domain = 'refunds'

const authorization = crudAuthorization([ROLE.MANAGER], [ROLE.EMPLOYER], [ROLE.MANAGER])

export const routes = (router) => [
  ...crud(domain, list, form, authorization),
  route(`${domain}-history`, history, { authorization: [ROLE.MANAGER] }, `${domain}history`),
  route(`${domain}-history/:id`, form, { scope: SCOPES.SCOPE_READONLY, authorization: [ROLE.MANAGER] }, `${domain}historyid`)
]
