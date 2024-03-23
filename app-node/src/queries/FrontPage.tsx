import { gql } from "@apollo/client";

export const FrontPageQuery = gql`
    query getFrontPage {
        generalSettings {
            title
            description
        }
    }
`;